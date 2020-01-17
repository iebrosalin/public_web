<?php use Components\View\SimpleView;

SimpleView::render('layouts/header_admin.php') ?>
<div class="mt-5">
    <p>The following tables were found:</p>
    <ul>
        <?php foreach ($options['tables'] as $key=>$value):?>
        <li><?php echo  $value ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php SimpleView::render('layouts/footer_admin.php') ?>