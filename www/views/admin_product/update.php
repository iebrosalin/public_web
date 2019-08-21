<?php use Components\View\SimpleView;

SimpleView::render('layouts/header_admin.php') ?>
<?= \Components\Helpers\Helpers::renderError($options['errors'])?>

    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-8 col-md-12">
            <form  action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="name" placeholder="Title" value="<?php echo $options['product']['name']; ?>">
                </div>

                <div class="form-group">
                    <label>Code</label>
                    <input type="text" class="form-control" name="code" placeholder="Code (numerical value)" value="<?php echo $options['product']['code']; ?>">
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="text" class="form-control" name="price" placeholder="Price (numerical value)" value="<?php echo $options['product']['price']; ?>">
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                        <?php if (is_array($options['categoriesList'])): ?>
                            <?php foreach ($options['categoriesList'] as $category): ?>
                                <option value="<?php echo $category['id']; ?>"
                                    <?php if ($options['product']['category_id'] == $category['id']) echo ' selected="selected"'; ?>>
                                    <?php echo $category['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Brand</label>
                    <input type="text" class="form-control" name="brand" placeholder="Brand" value="<?php echo $options['product']['brand']; ?>">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" placeholder="Description"><?php echo $options['product']['description']; ?></textarea>
                </div>

                <fieldset class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" value="1" <?=($options['product']['availability'] == 1)?'checked':'' ?> type="checkbox"  name="availability">
                            Availability
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" value="1" <?=($options['product']['is_new'] == 1)?'checked':'' ?> type="checkbox"  name="is_new">
                            New
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="1" <?=($options['product']['is_recommended'] == 1)?'checked':'' ?> name="is_recommended">
                            Recommended
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="1" <?=($options['product']['status'] == 1)?'checked':'' ?> name="status"">
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