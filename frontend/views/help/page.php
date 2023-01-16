<?php
/**
 * @var $this \yii\web\View
 * @var $page common\models\Page;
 * @var $categories array;
 */

use yii\helpers\Html;
use yii\helpers\Url;

$bg = '/img/types/10.jpg';
$title = 'Помощь';
?>



<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav  main_menu_ul top_lang_region">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Москва
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Москва</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Санкт-Петербург</a>
                <a class="dropdown-item" href="#">Калуга</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ru
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Ru</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">En</a>
            </div>
        </li>
    </ul>


    <ul class="navbar-nav mr-auto ml-auto main_menu_ul menul">
        <li class="nav-item active">
            <a class="nav-link" href="about">О проекте <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="experts">Эксперты</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="orders">Заявки</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="help">Помощь</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="contacts">Контакты</a>
        </li>


    </ul>
    <div class="form-inline my-2 my-lg-0 main_menu_right">
        <form>
            <ul class="navbar-nav mr-auto ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Регистрация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Вход</a>
                </li>


            </ul>
        </form>
    </div>

</div>
<div class="header_image" style="background-image: url(<?=  Url::to('@web/img/types/10.jpg')  ?>);">
    <div class="header_image_inner">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-12 text-center">

                    <div class="breads_wrapper">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>></span></li>
                            <li><span>Помощь</span></li>
                        </ul>
                        <h1><?= Html::encode($this->title) ?></h1>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<main class="help">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?= $page->content ?>
                </div>
                <div class="col-md-3">
                    <div class="help_lists">
                        <?php foreach($categories as $category):
                            /** @var $category \common\models\Category */
                            $pages = $category->pages;

                            if(isset($pages[0]))
                            {
                                $categoryUrl = Url::to(['/help/page', 'alias' => $pages[0]->url]);
                                echo "<a href='$categoryUrl'><h3>$category->name</h3></a>";
                            } else {
                                echo "<h3>$category->name</h3>";
                            }

                            if($page->category_id == $category->id){
                                echo "<ul>";
                                foreach($pages as $_page){
                                    $active = $_page->id == $page->id ? " class='active'" : "";

                                    $url = Url::to(['/help/page', 'alias' => $_page->url]);
                                    echo "<li$active><a href=\"$url\">$_page->name</a></li>";
                                }
                                echo "</ul>";
                            }
                        endforeach; ?>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><img class="mr10" src="/img/icons/general/q.jpg" alt="">Если остались вопросы обращайтесь <a href="mailto:askme@autotesmer.ru">askme@autotesmer.ru</a></p>
                </div>
            </div>
        </div>
    </div>
</main>
