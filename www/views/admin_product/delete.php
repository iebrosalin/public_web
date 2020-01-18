<?php
declare(strict_types=1);

use \Components\Helpers\Helpers;
use \Components\View\SimpleView;

SimpleView::render('layouts/header_admin.php') ?>

<?php Helpers::renderTitle('Delete product with id '.$options['id'])?>
<div class="row">
    <div class="col text-center">
        <p>Are you sure?</p>

        <form method="post" action="">
            <input type="submit" name="submit" class="btn btn-primary" value="Delete" />
        </form>
    </div>
</div>
<?php SimpleView::render('layouts/footer_admin.php') ?>

