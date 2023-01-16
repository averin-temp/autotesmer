<?php

/** @var $this \yii\web\View */
/** @var $cards array */
/** @var $user \common\models\User */

use yii\helpers\Url;


?>
    <main class="lk">
        <div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breads_wrapper dark">
                            <ul>
                                <li><a href="/">Главная</a></li>
                                <li><span>></span></li>
                                <li><span>Личный кабинет</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?php $menu = 'cards'; include __DIR__ . '/left-sidebar.php' ?>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="lk_expert_body">
                        <div class="lk_expert_body_packejes">
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="reg_exp_page_3">
                                            <h2>Карты</h2>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <?php foreach($cards as $card){
                                            echo $this->render('//lk/expert/card-block', ['card' => $card ]);
                                        }?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="registerCard" class="button button_orange" style="margin-top: 20px">Привязать карту</button>
                                        <div id="registration-form" style="display: none"></div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

<?php
$user_id = $user->id;
$getFormUrl = Url::to(['/card/regform']);
$script = <<< JS
$('#registerCard').click(function(){
    $(this).addClass('muted');
    $.post('$getFormUrl', {user_id: $user_id}, function(response){
        $('#registration-form').html(response);
        $('#registration-form form').submit();
    });
});
JS;
$this->registerJs($script);



