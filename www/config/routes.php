<?php

return array(

    'admin/product/create' => '\Controllers\AdminProductController#create',
    'admin/product/update/([0-9]+)' => '\Controllers\AdminProductController#update@$1',
    'admin/product/delete/([0-9]+)' => '\Controllers\AdminProductController#delete@$1',
    'admin/product' => '\Controllers\AdminProductController#index',

    'admin/category/create' => '\Controllers\AdminCategoryController#create',
    'admin/category/update/([0-9]+)' => '\Controllers\AdminCategoryController#update@$1',
    'admin/category/delete/([0-9]+)' => '\Controllers\AdminCategoryController#delete@$1',
    'admin/category' => '\Controllers\AdminCategoryController#index',

    'admin' => '\Controllers\AdminController#index',
    '' => '\Controllers\AdminController#index',
);
