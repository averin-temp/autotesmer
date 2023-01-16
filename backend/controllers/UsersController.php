<?php
namespace backend\controllers;


use app\models\UsersSearch;
use common\models\City;
use common\models\Group;
use common\models\Role;
use common\models\User;
//use function GuzzleHttp\default_ca_bundle;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Yii;
use yii\db\Query;
use \yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\base\Exception;
use yii\web\View;

/**
 * Site controller
 */
class UsersController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['accessUsers'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['edit', 'delete', 'save', 'add', 'batch'],
                        'roles' => ['editUsers'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Страница "Список пользователей"
     *
     * @return string
     * @throws NotAcceptableHttpException
     */
    public function actionIndex(){

        $searchModel = new UsersSearch();
        $users = $searchModel->search(\Yii::$app->request->get());

        $cities = City::find()->all();
        $groups = Group::find()->all();
        $roles = \Yii::$app->authManager->getRoles();
        return $this->render('list', [
            'users' => $users,
            'searchModel' => $searchModel,
            'cities' => $cities,
            'groups' => $groups,
            'roles' => $roles,
        ]);
    }


    public function actionEdit($id){

        $user = User::findOne($id);

        if($user->can('Эксперт'))
            return $this->redirect(['/expert/settings', 'id' => $user->id]);
        if($user->can('Клиент'))
            return $this->redirect(['/client/settings', 'id' => $user->id]);

        $authManager = \Yii::$app->authManager;
        $roles = $authManager->getRoles();
        $userRole = $user->role;
        $userGroups = ArrayHelper::getColumn($user->groups, 'id');
        $groups = Group::find()->all();
        $socials = \Yii::$app->oauth->socials;
        return $this->render('edit', [
            'user' => $user,
            'roles' => $roles,
            'userRole' => $userRole,
            'userGroups' => $userGroups,
            'groups' => $groups,
            'socials' => $socials
        ]);
    }

    public function actionAdd(){
        $user = new User(['_role' => "Администратор"]);
        $authManager = \Yii::$app->authManager;
        $roles = $authManager->getRoles();
        $groups = Group::find()->all();
        $userRole = null;
        $userGroups = [];
        return $this->render('edit', [
            'user' => $user,
            'roles' => $roles,
            'userRole' => $userRole,
            'userGroups' => $userGroups,
            'groups' => $groups,
            'socials' => []
        ]);
    }

    public function actionDelete($id){

        try{
            if(!$user = User::findOne($id))
                throw new \Exception('Не найден пользователь');

            $user->delete();
            \Yii::$app->session->setFlash('operation-report', ['success' => true, 'message' => "Успешно удалено" ]);
        } catch(\Exception $e){
            \Yii::$app->session->setFlash('operation-report', ['success' => false, 'message' => $e->getMessage() ]);
        }

        return $this->redirect(['/users']);

    }

    /**
     * Сохранить пользователя
     *
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionSave(){

        if($id = Yii::$app->request->post('id')){
            if(!$user = User::findOne($id))
                throw new NotFoundHttpException("Не найден указанный пользователь");
        } else {
            $user = new User();
        }

        $user->scenario = User::SCENARIO_ADMIN_SAVE;
        $user->active = 1;
        if($user->load(Yii::$app->request->post(), '') && $user->save()){

            if($user->can('Клиент')) {
                $route = '/client/settings';
                $flashKey = 'client-settings';
            } elseif($user->can('Эксперт')) {
                $route = '/expert/settings';
                $flashKey = 'expert-settings';
            } else {
                $flashKey = 'user-settings';
                $route = '/users/edit';
            }

            $this->setFlash($flashKey, 'success', 'Пользователь сохранен');
            return $this->redirect([ $route , 'id' => $user->id]);
        }

        $authManager = \Yii::$app->authManager;
        $roles = $authManager->getRoles();
        $groups = Group::find()->all();
        $userRole = $user->role;
        $userGroups = ArrayHelper::getColumn($user->groups, 'id');

        if(\Yii::$app->user->identity->id == $user->id){
            $socials = \Yii::$app->oauth->socials;
        } else {
            $socials = [];
        }


        return $this->render('edit', [
            'user' => $user,
            'roles' => $roles,
            'userRole' => $userRole,
            'userGroups' => $userGroups,
            'groups' => $groups,
            'socials' => $socials
        ]);


        return $this->render('edit', ['user' => $user]);
    }

    private function setFlash($key,$status, $message){
        \Yii::$app->session->setFlash($key, [ 'status' => $status, 'message' => $message ]);
    }

    public function actionBatch(){

        $request = \Yii::$app->request;

        $ids = json_decode($request->post('ids'));
        $ids = array_map('intval', $ids);
        $action = $request->post('action');

        try{
            if($action == 'delete')
            {
                $users = User::findAll(['id' => $ids]);

                foreach($users as $user){
                    $user->delete();
                }

                \Yii::$app->session->setFlash('operation-report', ['success' => true, 'message' => "Пользователи удалены" ]);
            }

        } catch (Exception $e){
            \Yii::$app->session->setFlash('operation-report', ['success' => false, 'message' => $e->getMessage() ]);
        }

        return $this->redirect(['index']);
    }
}
