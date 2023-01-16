<?php

/**
 * @var $this \yii\web\View
 * @var $current_user \common\models\User
 * @var $notifications array
 * @var $new_messages bool
 * @var $is_guest bool
 */

use yii\helpers\Url;

use frontend\assets\NotificationsAsset;

NotificationsAsset::register($this);

?>

<?php if($is_guest): ?>
    <div class="form-inline my-2 my-lg-0 main_menu_right">
        <form>
            <ul class="navbar-nav mr-auto ml-auto">
                <li class="nav-item">
                    <a class="nav-link registration-button" href="<?= Url::to(['/registration']) ?>">Регистрация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['/login']) ?>">Вход</a>
                </li>
            </ul>
        </form>
    </div>
<?php else: ?>
    <div class="form-inline my-2 my-lg-0 main_menu_right">
        <form class="d-flex flex-column flex-lg-row w-100">
            <ul class="navbar-nav mr-auto ml-auto d-flex flex-lg-row flex-column justify-content-center">
                <li class="nav-item item_bell">
                    <a class="nav-link text-center text-lg-left" href="#">
                        <img src="<?= Url::to('@web/img/icons/svg/notification.svg') ?>" alt="">
                    </a>

                    <?php if($new_messages): ?>
                        <div class="addit"></div>
                    <?php endif; ?>

                    <div class="uvlist">
                        <div class="uvlist_top">Уведомления</div>
                        <div class="uvlist_content">
                            <?php if(empty($notifications)) {
                                echo "Нет уведомлений";
                            } else {
                            foreach($notifications as $notification): ?>
                            <div class="uvlist_content_item">
                                <div class="uvlist_content_item_min" data-notification="<?= $notification->id ?>"><?= $notification->getTime("j.n.Y") ?></div>
                                <?= $notification->render() ?>
                            </div>
                            <?php endforeach;
                            } ?>


                        </div>
                    </div>
                </li>
                <!--li class="nav-item item_conv">
                    <a class="nav-link text-center text-lg-left" href="#">
                        <img src="<?= Url::to('@web/img/icons/svg/close-envelope.svg') ?>" alt="">
                    </a>
                </li-->
                <li class="nav-item d-flex flex-lg-row flex-column align-items-center">
                    <br>
                    <a class="nav-link" href="<?= Url::toRoute('/lk') ?>">
                        <span class="header_name" style="background-image: url('<?= $current_user->avatar ?>')"></span>
                    </a>
                    <br>
                    <a href="<?= Url::to('/logout') ?>" class="navlogout">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </form>
    </div>
<?php endif; ?>
