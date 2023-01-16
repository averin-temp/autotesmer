<?php

use yii\helpers\Url;

?>


<?php if(!empty($networks)): ?>

    <div class="row" style="display: none">
        <div class="col-md-4 offset-md-4 orimg">
            <img src="<?= Url::to('@web/img/common/or.jpg') ?>" alt="">
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="enter_socs">
                <h2>Регистрация по соц. сети</h2>
                <div class="com_enters">
                    <?php $images = [
                        'mail.ru' => Url::to('@web/img/common/en_3.jpg'),
                        'vk' => Url::to('@web/img/common/en_1.jpg'),
                        'facebook' => Url::to('@web/img/common/en_2.jpg'),
                    ];

                    foreach($networks as $id => $network): /** @var $social \common\interfaces\OauthInterface */
                        $registrationLink = Url::to(['registration/register_social', 'social' => $id , 'type' => $type ]);
                        $class = 'social-login-' . str_replace('.','_', $id);
                    ?>
                        <a class="<?= $class ?>" href="<?= $registrationLink ?>">
                            <img src="<?= $images[$id] ?>" alt="">
                        </a>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
