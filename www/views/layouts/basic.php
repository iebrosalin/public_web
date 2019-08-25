<?php

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language?>>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container">
        <ul class="nav nav-pills">
            <li class="active"><?= Html::a('Главная', '/web/') ?></li>
            <li><?= Html::a('Статьи', ['post/index']) ?></li>
            <li><?= Html::a('Статья', ['post/show']) ?></li>
            <!--    <li class="disabled"><a href="#">Disabled</a></li>-->
            <!--    <li class="dropdown">-->
            <!--        <a class="dropdown-toggle" data-toggle="dropdown" href="#">-->
            <!--            Dropdown <span class="caret"></span>-->
            <!--        </a>-->
            <!--        <ul class="dropdown-menu">-->
            <!--            <li><a href="#">Action</a></li>-->
            <!--            <li><a href="#">Another action</a></li>-->
            <!--            <li><a href="#">Something else here</a></li>-->
            <!--            <li class="divider"></li>-->
            <!--            <li><a href="#">Separated link</a></li>-->
            <!--        </ul>-->
            <!--    </li>-->
        </ul>
        <?= $content ?>
<!--        --><?php //ebug($this->blocks)?>
        <?php if(isset($this->blocks['block1'])):?>
            <?= $this->blocks ['block1']?>
        <?php endif; ?>
    </div>
</div>


<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
