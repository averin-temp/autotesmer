<?php

/**
 * @var $this yii\web\View
 * @var $banner \common\models\Banner
 * @var $groups array
 * @var $report array
 */

use common\models\Banner;
use backend\assets\DateRangeAsset;
use backend\assets\InputmaskAsset;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

InputmaskAsset::register($this);
DateRangeAsset::register($this);

?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Редактор баннера
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="#">Баннеры</a></li>
            <li class="active">Редактор баннера</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php if($report = Yii::$app->session->getFlash('edit-banner')): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
            </div>
        <?php endif; ?>

        <div class="box">
            <form action="<?= Url::to(['edit', 'id' => $banner->id]) ?>" method="post" enctype="multipart/form-data">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="inputName">Название</label>
                            <input name="name" id="inputName" type="text" class="form-control" value="<?= $banner->name ?>">
                            <?php if($banner->hasErrors('name')): ?>
                                <div class="form-error field-name"><?= $banner->getFirstError('name') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="inputOrder">Порядок</label>
                            <input name="order" id="inputOrder" type="number" class="form-control" value="<?= $banner->order ?>">
                            <?php if($banner->hasErrors('order')): ?>
                                <div class="form-error field-name"><?= $banner->getFirstError('order') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="inputUrl">URL</label>
                            <input name="url" id="inputUrl" type="text" class="form-control" value="<?= $banner->url ?>">
                            <?php if($banner->hasErrors('url')): ?>
                                <div class="form-error field-name"><?= $banner->getFirstError('url') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="inputPositions">Позиция</label>
                            <select name="_positions[]" id="inputPositions" multiple class="form-control">
                                <?php foreach(Banner::positions() as $value => $label) {
                                    $selected = in_array($value, $banner->positions) ? "selected" : "";
                                    echo "<option value='$value' $selected>$label</option>";
                                } ?>
                            </select>
                        </div>

                        <?php if($banner->hasErrors('_positions')) echo "<div>{$banner->getFirstError('_positions')}</div>"; ?>


                        <div class="form-group">
                            <label for="inputGroups">Показывать пользователям из групп</label>
                            <select name="_groups[]" id="inputGroups" multiple class="form-control">
                                <?php foreach($groups as $group) {
                                    /** @var common\models\Group $group */
                                    $selected = in_array( $group->id, ArrayHelper::getColumn($banner->groups, 'id') ) ? "selected" : "";
                                    echo "<option value='$group->id' $selected>$group->name</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <?php if($banner->hasErrors('_groups')) echo "<div>{$banner->getFirstError('_groups')}</div>"; ?>

                    </div>
                </div>



                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Загрузить баннер</label>
                            <input name="banner_file" type="file" class="form-control">
                            <?php if($banner->hasErrors('uploadedImage')): ?>
                                <div class="form-error field-name"><?= $banner->getFirstError('uploadedImage') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="preview-wrapper" id="preview">
                            <img id="preview-img" style="width:100%; height: auto" src="<?= $banner->getImageUrl() ?>" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>




            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-info">Сохранить</button>
            </div>
            </form>
        </div><!-- /.box -->

    </section><!-- /.content -->
<?php

$script = <<< JS


$('[name=banner_file]').change(function(){
    let file = this.files[0];
    let reader = new FileReader();
    let image = document.getElementById('preview-img');
    reader.onload = function(result){
        image.src = reader.result;
    }
    reader.readAsDataURL(file);
});
JS;
$this->registerJs($script, \yii\web\View::POS_READY);
