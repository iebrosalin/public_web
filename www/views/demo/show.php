<?php use app\components\MyWidget;?>

<h1>Show all demo</h1>

<?php $this->beginBlock('block1');?>
<div>
    <p>Block paste to layout from other view</p>
</div>
<button class="btn btn-success" id="btn"> Test ajax </button>
<?php $this->endBlock();?>
    <hr/>
<?= MyWidget::widget(['name'=>'MyWidget Admin pass as param'])?>
<?= MyWidget::widget()?>
<?php MyWidget::begin()?>
    MyWidget pass content and uppercase after
<?php MyWidget::end()?>
    <hr/>


    <hr/>
<p>Date picker from plugin</p>
<?= yii\jui\DatePicker::widget(['name' => 'attributeName']) ?>
    <hr/>
<div style="height: 300px; overflow-y: scroll; overflow-x: scroll;">
    <p>Something select</p>
    <?php

    foreach ($cats as $v){
        debug($cats);
    }
    ?>
</div>

    <hr/>
<p>Some refs to the results of generate gii</p>
<?php echo \yii\helpers\Html::a("Products", "/products"); ?>
<br/>
<?php echo \yii\helpers\Html::a("Categories", "/categories"); ?>

<?php

/**
 * Register js
 */

//$this->title='One article';
//$this->registerJsFile('@web/js/script.js',['depends'=>'yii\web\YiiAsset']);

//$this->registerJs("$('.container').append('<p>Jquery loaded</p>');",\yii\web\View::POS_LOAD);

$js=<<<JS
    $('#btn').on('click',function() {
      $.ajax(
          {
               url: '/demo/demo-ajax',
               type:'post',
               data: {test:'123'},
               success: function(res) {
                 alert(res);
               },
               error:function() {
                 alert('Error!');
               }          
          })
    });
JS;
$this->registerJs($js);


