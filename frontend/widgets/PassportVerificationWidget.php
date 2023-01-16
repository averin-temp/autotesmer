<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 29.09.2019
 * Time: 3:20
 */

namespace frontend\widgets;


use yii\base\Widget;
use common\models\PassportVerification;

/**
 * Class PassportVerification
 * @package frontend\widgets
 *
 * @property PassportVerification $verification
 */
class PassportVerificationWidget extends Widget
{
    public $verification;

    public function run()
    {

        if(!$this->verification){
            $this->verification = new PassportVerification();
            return $this->render('//widgets/passport-verification/start', ['verification' => $this->verification ]);
        }

        if($this->verification->status == PassportVerification::STATUS_UPLOAD_PASSPORT){
            return $this->render('//widgets/passport-verification/passport-upload', ['verification' => $this->verification ]);
        }

        if($this->verification->status == PassportVerification::STATUS_UPLOAD_SELFIE){
            return $this->render('//widgets/passport-verification/selfie-upload', ['verification' => $this->verification ]);
        }

        if($this->verification->status == PassportVerification::STATUS_WAITING_VERIFICATION){
            return $this->render('//widgets/passport-verification/waiting', ['verification' => $this->verification ]);
        }

        if($this->verification->status == PassportVerification::STATUS_VERIFYED){
            return $this->render('//widgets/passport-verification/verifyed', ['verification' => $this->verification ]);
        }

        if($this->verification->status == PassportVerification::STATUS_REJECTED){
            return $this->render('//widgets/passport-verification/rejected', ['verification' => $this->verification ]);
        }

        return '';
    }

}