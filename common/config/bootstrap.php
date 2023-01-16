<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@Embed', dirname(dirname(__DIR__)) . '/embed');
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@uploads', dirname(dirname(__DIR__)) . '/frontend/web/uploads');

Yii::setAlias('@libs', dirname(dirname(__DIR__)) . '/libs');
Yii::setAlias('@Dompdf', '@libs/dompdf/src');
Yii::setAlias('@FontLib', '@libs/dompdf/lib/php-font-lib/src/FontLib');
Yii::setAlias('@Svg', '@libs/dompdf/lib/php-svg-lib/src/Svg');

Yii::$classMap['HTML5_Parser'] = '@libs/dompdf/lib/html5lib/Parser.php';
Yii::$classMap['Cpdf'] = '@libs/dompdf/lib/Cpdf.php';

include "bootstrap-local.php";