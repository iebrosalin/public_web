<?php

use \Components\Helpers\Helpers;
use Components\View\SimpleView;

SimpleView::render('layouts/header_admin.php') ?>

<?php echo Helpers::renderTitle('Delete category id '.$options['id'])?>
<div class="row">
    <div class="col text-center">
        <p>Are you sure?</p>

        <form method="post" action="">
            <input type="submit" name="submit" class="btn btn-primary" value="Delete" />
        </form>
    </div>
</div>
<?php SimpleView::render('layouts/footer_admin.php') ?>

