<?php use Components\View\SimpleView;

SimpleView::render('layouts/header_admin.php') ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Home /</a></li>
                    <li><a href="/admin/category">Category /</a></li>
                    <li class="active">Add</li>
                </ol>
            </div>


            <h4>Add category</h4>

            <br/>

            <?php if (isset($options['errors']) && is_array($options['errors'])): ?>
                <ul>
                    <?php foreach ($options['errors'] as $error): ?>
                        <li> <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Name</p>
                        <input type="text" name="name" placeholder="" value="">

                        <p>Order number</p>
                        <input type="text" name="sort_order" placeholder="" value="">

                        <p>Status</p>
                        <select name="status">
                            <option value="1" selected="selected">Displayed</option>
                            <option value="0">Hidden</option>
                        </select>

                        <br><br>

                        <input type="submit" name="submit" class="btn btn-default" value="Save">
                    </form>
                </div>
            </div>


        </div>
    </div>
</section>

<?php SimpleView::render('layouts/footer_admin.php') ?>




