<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

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
            <li class="active"><?php echo  Html::a('Home',Url::to('/'))?></li>
            <li><?= Html::a('Form add post',Url::to('/demo/index')) ?></li>
            <li><?= Html::a('Demo other examples', Url::to('/demo/show')) ?></li>
        </ul>
        <?= $content ?>
        <?php if(isset($this->blocks['block1'])):?>
            <?= $this->blocks ['block1']?>
        <?php endif; ?>
    </div>
</div>


<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
