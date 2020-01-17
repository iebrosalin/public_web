<?php

use Components\View\SimpleView;

SimpleView::render('layouts/header_admin.php') ?>
<div class="error-container">
    <p class="error-header">Error 500</p>
    <p><?php echo  $options['message']?></p>
</div>
<?php SimpleView::render('layouts/footer_admin.php') ?>
