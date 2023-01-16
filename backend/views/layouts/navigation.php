<?php

use yii\helpers\Url;

$user = \Yii::$app->user->identity;

$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;


?>
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="<?= $user->avatar ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p><?= ucfirst($user->firstname) . ' ' . ucfirst($user->family) ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">Навигация</li>
        <?php if(\Yii::$app->user->can('accessUsers') || \Yii::$app->user->can('accessVerifications') ||
                 \Yii::$app->user->can('accessRoles') || \Yii::$app->user->can('accessGroups')):
                $opened = in_array($controller , ["users", "groups", "roles", "verifications" ]);
            ?>
        <li class="treeview<?=  $opened ? ' active' : '' ?>">
            <a href="">
                <i class="fa fa-users"></i> <span>Пользователи</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu<?= $opened  ? ' menu-open' : '' ?>"<?= $opened  ? ' style="display: block"' : '' ?>>

                <?php if(\Yii::$app->user->can('accessUsers')): ?>
                <li<?= Yii::$app->controller->action == "index" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['users/index']) ?>"><i class="fa fa-circle-o"></i> Список пользователей</a>
                </li>
                <?php endif; ?>

                <?php if(\Yii::$app->user->can('editUsers')): ?>
                <li<?= Yii::$app->controller->action == "adduser" ? 'class="active"' : '' ?>>
                    <a href="<?= Url::to(['users/add']) ?>"><i class="fa fa-circle-o"></i> Добавить пользователя</a>
                </li>
                <?php endif; ?>

                <?php if(\Yii::$app->user->can('accessGroups')): ?>
                <li<?= Yii::$app->controller->action == "groups" ? 'class="active"' : '' ?>>
                    <a href="<?= Url::to(['groups/index']) ?>"><i class="fa fa-circle-o"></i> Группы</a>
                </li>
                <?php endif; ?>

                <?php if(\Yii::$app->user->can('editGroups')): ?>
                <li>
                    <a href="<?= Url::to(['groups/add']) ?>"><i class="fa fa-circle-o"></i> Добавить группу</a>
                </li>
                <?php endif; ?>

                <?php if(\Yii::$app->user->can('accessRoles')): ?>
                <li<?= $action == "roles" ? 'class="active"' : '' ?>>
                    <a href="<?= Url::to(['roles/index']) ?>"><i class="fa fa-circle-o"></i> Роли</a>
                </li>
                <?php endif; ?>

                <?php if(\Yii::$app->user->can('editRoles')): ?>
                <li<?= Yii::$app->controller->action == "addrole" ? 'class="active"' : '' ?>>
                    <a href="<?= Url::to(['roles/add']) ?>"><i class="fa fa-circle-o"></i> Создать роль</a>
                </li>
                <?php endif; ?>

                <?php if(\Yii::$app->user->can('accessVerifications')): ?>
                <li<?= Yii::$app->controller->action == "list" ? 'class="active"' : '' ?>>
                    <a href="<?= Url::to(['verifications/list']) ?>"><i class="fa fa-circle-o"></i> Проверка документов</a>
                </li>
                <?php endif; ?>

            </ul>
        </li>
        <?php endif; ?>

        <?php if(\Yii::$app->user->can('accessCategories') || \Yii::$app->user->can('accessPages')):
            $opened = $controller == "pages" || $controller == "category";
            ?>
        <li class="treeview<?= $opened  ? ' active' : '' ?>">
            <a href="">
                <i class="fa fa-sticky-note-o"></i> <span>Страницы</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu<?= $opened  ? ' menu-open' : '' ?>"<?= $opened  ? ' style="display: block"' : '' ?>>

                <?php if(\Yii::$app->user->can('accessPages')): ?>
                <li<?= $controller == "pages" && $action == "list" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['pages/list']) ?>"><i class="fa fa-circle-o"></i> Список страниц</a>
                </li>
                <?php endif; ?>

                <?php if(\Yii::$app->user->can('editPages')): ?>
                <li<?= $controller == "pages" && $action == "create" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['pages/create']) ?>"><i class="fa fa-circle-o"></i> Создать страницу</a>ы
                </li>
                <?php endif; ?>

                <?php if(\Yii::$app->user->can('accessCategories')): ?>
                <li<?= $controller == "category" && $action == "list" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['category/list']) ?>"><i class="fa fa-circle-o"></i> Категории</a>
                </li>
                <?php endif; ?>

                <?php if(\Yii::$app->user->can('editCategories')): ?>
                <li<?= $controller == "category" && $action == "edit" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['category/create']) ?>"><i class="fa fa-circle-o"></i> Создать категорию</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <?php if(\Yii::$app->user->can('accessPackages')):
            $opened = Yii::$app->controller->id == "packages";
            ?>
        <li class="treeview<?= $opened ? ' active' : '' ?>">
            <a href="">
                <i class="fa fa-cubes"></i> <span>Пакеты</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu<?= $opened  ? ' menu-open' : '' ?>"<?= $opened  ? ' style="display: block"' : '' ?>>
                <li<?= Yii::$app->controller->action == "list" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['packages/list']) ?>"><i class="fa fa-circle-o"></i> Список пакетов</a>
                </li>

                <?php if(\Yii::$app->user->can('editPackages')): ?>
                <li<?= Yii::$app->controller->action == "add" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['packages/add']) ?>"><i class="fa fa-circle-o"></i> Создать пакет</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <?php if(\Yii::$app->user->can('accessBanners')):
            $opened = Yii::$app->controller->id == "banners";
            ?>
        <li class="treeview<?= $opened ? ' active' : '' ?>">
            <a href="">
                <i class="fa fa-tv"></i> <span>Баннеры</span><i class="fa fa-angle-left pull-right"></i>

            </a>
            <ul class="treeview-menu<?= $opened  ? ' menu-open' : '' ?>"<?= $opened  ? ' style="display: block"' : '' ?>>
                <li<?= Yii::$app->controller->action == "index" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['banners/index']) ?>"><i class="fa fa-circle-o"></i> Список баннеров</a>
                </li>

                <?php if(\Yii::$app->user->can('editBanners')): ?>
                <li<?= Yii::$app->controller->action == "index" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['banners/edit']) ?>"><i class="fa fa-circle-o"></i> Новый баннер</a>ы
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <?php if(\Yii::$app->user->can('accessPromocodes')):
            $opened = $controller == "promocodes";
            ?>
        <li class="treeview<?= $opened ? ' active' : '' ?>">
            <a href="">
                <i class="fa fa-th-large"></i> <span>Промокоды</span><i class="fa fa-angle-left pull-right"></i>

            </a>
            <ul class="treeview-menu<?= $opened  ? ' menu-open' : '' ?>"<?= $opened  ? ' style="display: block"' : '' ?>>
                <li<?= $controller == "promocodes" && $action == "list" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['promocodes/list']) ?>"><i class="fa fa-circle-o"></i> Наборы</a>
                </li>

                <?php if(\Yii::$app->user->can('editPromocodes')): ?>
                <li<?= $controller == "promocodes" && $action == "create" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['promocodes/create']) ?>"><i class="fa fa-circle-o"></i> Новый набор</a>ы
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <?php if(\Yii::$app->user->can('accessMenu')):
            $opened = Yii::$app->controller->id == "menu";
            ?>
        <li class="treeview<?= $opened ? ' active' : '' ?>">
            <a href="">
                <i class="fa fa-th-large"></i> <span>Меню</span><i class="fa fa-angle-left pull-right"></i>

            </a>
            <ul class="treeview-menu<?= $opened  ? ' menu-open' : '' ?>"<?= $opened  ? ' style="display: block"' : '' ?>>
                <li<?= Yii::$app->controller->action == "index" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['menu/index']) ?>"><i class="fa fa-circle-o"></i> Список меню</a>
                </li>
                <?php if(\Yii::$app->user->can('editMenu')): ?>
                <li<?= Yii::$app->controller->action == "index" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['menu/add']) ?>"><i class="fa fa-circle-o"></i> Новое меню</a>ы
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <?php if(\Yii::$app->user->can('accessMailing') || \Yii::$app->user->can('accessMailTemplates')):
            $opened = in_array($controller , ["mailing", "mail_templates" ]);
            ?>
        <li class="treeview<?= $opened ? ' active' : '' ?>">
            <a href="">
                <i class="fa fa-th-large"></i> <span>Рассылки</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu<?= $opened  ? ' menu-open' : '' ?>"<?= $opened  ? ' style="display: block"' : '' ?>>
                <?php if(\Yii::$app->user->can('accessMailing')): ?>
                <li<?= $controller == "mailing" && $action == "list" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['mailing/list']) ?>"><i class="fa fa-circle-o"></i> Список рассылок</a>
                </li>
                <?php endif; ?>
                <?php if(\Yii::$app->user->can('editMailing')): ?>
                <li<?= $controller == "mailing" && $action == "create" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['mailing/create']) ?>"><i class="fa fa-circle-o"></i> Создать рассылку</a>
                </li>
                <?php endif; ?>
                <?php if(\Yii::$app->user->can('accessMailTemplates')): ?>
                <li<?=  $controller == "mail_templates" && $action == "list" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['mail_templates/list']) ?>"><i class="fa fa-circle-o"></i> Шаблоны писем</a>
                </li>
                <?php endif; ?>
                <?php if(\Yii::$app->user->can('editMailTemplates')): ?>
                <li<?= $controller == "mail_templates" && $action == "create" ? ' class="active"' : '' ?>>
                    <a href="<?= Url::to(['mail_templates/create']) ?>"><i class="fa fa-circle-o"></i> Создать шаблон</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <?php if(\Yii::$app->user->can('accessArbitrage')):
            $opened = Yii::$app->controller->id == "arbitration";
            ?>
        <li<?= $opened ? ' class="active"' : '' ?>>
            <a href="<?= Url::to(['/disputes']) ?>">
                <i class="fa fa-eye"></i> <span>Арбитраж</span>
            </a>
        </li>
        <?php endif; ?>

        <?php if(\Yii::$app->user->can('accessAdvertising')):
            $opened = Yii::$app->controller->id == "advertising";
            ?>
            <li<?= $opened ? ' class="active"' : '' ?>>
                <a href="<?= Url::to(['/advertising']) ?>">
                    <i class="fa fa-eye"></i> <span>Реклама</span>
                </a>
            </li>
        <?php endif; ?>
        <?php $opened = Yii::$app->controller->id == "admin_notification"; ?>
            <li<?= $opened ? ' class="active"' : '' ?>>
                <a href="<?= Url::to(['/admin_notification']) ?>">
                    <i class="fa fa-eye"></i> <span>Сообщения</span>
                </a>
            </li>

    </ul>
</section>
<!-- /.sidebar -->
