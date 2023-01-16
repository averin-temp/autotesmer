<?php
namespace frontend\controllers;

use common\classes\DataHelper;
use common\models\City;
use common\models\Dial;
use common\models\User;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\Pagination;
use yii\db\Query;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\classes\OrderCategory;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * Лэндинг.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'landing';
        return $this->render('index');
    }



    public function actionExperts()
    {
        $categories = OrderCategory::categories();

        $sort = DataHelper::getParam('sort', ['rating', 'time', 'completed'], 'rating');
        $currentCategory = DataHelper::getParam('category',  array_merge(array_keys($categories),['all']), 'all');
        $limit = DataHelper::getParam('limit', ['1','10', '50', '100'], '10');
        $tableStyle = DataHelper::getParam('style', ['tile','row'], 'tile');
        $currentRegion = \Yii::$app->session->get('city', City::defaultCity()->id);
        $expertIds = \Yii::$app->authManager->getUserIdsByRole('Эксперт');

        $query = User::find()->from(['u' => User::tableName()])
            ->select('u.*, COUNT(*) as completed')
            ->where(['u.id' => $expertIds])
            ->andWhere(['u.city_id' => $currentRegion])
            ->groupBy('u.id')
            ->limit($limit);

        if($currentCategory !== 'all'){
            $categoryField = 'category_' . $categories[$currentCategory]['alias'];
            $query->andWhere([$categoryField => 1]);
        }

        if($sort == 'rating'){
            $query->orderBy('rating');
        }
        if($sort == 'completed'){
            $query->leftJoin(['d' => Dial::tableName() ], 'd.expert_id = u.id')
                ->andWhere(['d.status' => Dial::STATUS_COMPLETED])
                ->orderBy('completed');

        }
        if($sort == 'time'){
            $query->orderBy('u.created_at');
        }

        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => $limit,
        ]);

        $query->offset($pages->offset);

        $experts = $query->all();

        return $this->render('experts', [
            'experts' => $experts,
            'vip_experts' => $experts,
            'currentCategory' => $currentCategory,
            'tableStyle' => $tableStyle,
            'sort' => $sort,
            'limit' => $limit,
            'pages' => $pages
        ]);
    }


    /**
     * Регистрация.
     *
     * @return mixed
     */


    public function actionCity($id){
        \Yii::$app->session->set('city', $id);
        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionLang($id){
        \Yii::$app->session->set('lang', $id);
        return $this->redirect(\Yii::$app->request->referrer);
    }



    public function actionHelp(){

        $this->layout = 'page';
        return $this->render('help');

    }

    public function actionHelp2(){

        $this->layout = 'page';
        return $this->render('help2');

    }



    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            $socials = \Yii::$app->oauth->getSocials();
            return $this->render('login', [
                'model' => $model,
                'socials' => $socials
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContacts()
    {
        $this->layout = 'page';
        $this->view->params['image'] = '@web/img/types/6.jpg';
        $this->view->title = "Контакты";
        return $this->render('contact');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $this->layout = 'page';
        $this->view->params['image'] = '@web/img/big_img/29.jpg';
        $this->view->title = "О проекте";
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


    public function actionPolitic()
    {
        return $this->render('politic');
    }

    public function actionSafety()
    {
        return $this->render('safety');
    }


}
