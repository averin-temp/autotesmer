<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Class ExpertInfoModel
 * @package frontend\models
 *
 * @property string $resume
 * @property string $about
 * @property string $text
 * @property string $status
 * @property string $busyness
 */
class ExpertInfoModel extends Model{

    public $resume;
    public $about;
    public $text;
    public $status;
    public $busyness;

    private $_expert;



    public function __construct($user_id)
    {
        parent::__construct();
        $this->_expert = User::findOne($user_id);
        if(!$this->_expert)
            throw new NotFoundHttpException("Пользователь не найден");

        $this->_expert->resume = $this->resume;
        $this->_expert->about = $this->about;
        $this->_expert->text = $this->text;
        $this->_expert->status = $this->status;
        $this->_expert->busyness = $this->busyness;
    }

    public function rules()
    {
        return [
            [['resume', 'about', 'status', 'text'], 'trim'],
            [['busyness'], 'number'],
        ];
    }

    public function save(){
        $expert = $this->_expert;
        $expert->resume = $this->resume;
        $expert->about = $this->about;
        $expert->text = $this->text;
        $expert->status = $this->status;
        $expert->busyness = $this->busyness;
        if($expert->save(false))
            return true;

        return false;
    }




}