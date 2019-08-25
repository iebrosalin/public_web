<h1>Show</h1>
<?php
use app\components\MyWidget;

$this->beginBlock('block1');?>
<button class="btn btn-success" id="btn"> Click me...</button>
<?php $this->endBlock();?>

<?//= MyWidget::widget(['name'=>'Admin'])?>

<?php MyWidget::begin()?>
<h1>Привет мир</h1>
<?php MyWidget::end()?>
<?= yii\jui\DatePicker::widget(['name' => 'attributeName']) ?>
<?php

//    foreach ($cats as $v){
//        ebug($cats);
//}
?>
<?php
//$this->title='One article';
//$this->registerJsFile('@web/js/script.js',['depends'=>'yii\web\YiiAsset']);

//$this->registerJs("$('.container').append('<p>Jquery loaded</p>');",\yii\web\View::POS_LOAD);

$js=<<<JS
    $('#btn').on('click',function() {
      $.ajax(
          {
               url: 'index.php?r=post/index',
               type:'post',
               data: {test:'123'},
               success: function(res) {
                 console.log(res);
               },
               error:function() {
                 alert('Error!');
               }          
          })
    });
JS;
$this->registerJs($js);


