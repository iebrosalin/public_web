<?php
declare(strict_types=1);

use Components\Helpers\Helpers;
use Components\View\SimpleView;

SimpleView::render('layouts/header_admin.php') ?>

<?= Helpers::renderTitle('Add product');?>
<?= Helpers::renderError($options['errors'])?>

<div class="row justify-content-center">

    <div class="col-xl-6 col-lg-8 col-md-12">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="name" placeholder="Title" required>
            </div>

            <div class="form-group">
                <label>Code</label>
                <input type="number" class="form-control" name="code" placeholder="Code (numerical value)" required>
            </div>

            <div class="form-group">
                <label>Price</label>
                <input type="number" class="form-control" name="price" placeholder="Price (numerical value)" required>
            </div>

            <div class="form-group">
                <label>Category</label>
                <label>
                    <select class="form-control" name="category_id">
                        <?php if (is_array($options['categoriesList'])): ?>
                            <?php foreach ($options['categoriesList'] as $category): ?>
                                <option value="<?php echo $category['id']; ?>">
                                    <?php echo $category['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </label>
            </div>

            <div class="form-group">
                <label>Brand</label>
                <input type="text" class="form-control" name="brand" placeholder="Brand" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description" placeholder="Description"> </textarea>
            </div>

            <fieldset class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1" name="availability">
                        Availability
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1" name="is_new">
                        New
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1" name="is_recommended">
                        Recommended
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1" name="status"">
                        Status
                    </label>
                </div>
            </fieldset>
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-primary" value="Save">
            </div>
        </form>

    </div>
</div>

<?php SimpleView::render('layouts/footer_admin.php') ?>

