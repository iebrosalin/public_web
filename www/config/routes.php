<?php
declare(strict_types=1);

return [

    'admin/product/create' => '\Controllers\AdminProductController#create',
    'admin/product/update/([0-9]+)' => '\Controllers\AdminProductController#update@$1',

    'admin/product/delete/([0-9]+)' => '\Controllers\AdminProductController#delete@$1',
    'admin/product/delete' => '\Controllers\AdminProductController#index',

    'admin/product' => '\Controllers\AdminProductController#index',

    'admin/category/create' => '\Controllers\AdminCategoryController#create',
    'admin/category/update/([0-9]+)' => '\Controllers\AdminCategoryController#update@$1',

    'admin/category/delete/([0-9]+)' => '\Controllers\AdminCategoryController#delete@$1',
    'admin/category/delete' => '\Controllers\AdminCategoryController#index',

    'admin/category' => '\Controllers\AdminCategoryController#index',

    'admin/echo-request/get(\?.*)?' => '\Controllers\AdminEchoRequestController#get',
    'admin/echo-request/post' => '\Controllers\AdminEchoRequestController#post',
    'admin/echo-request' => '\Controllers\AdminEchoRequestController#index',

    '404'=>'\Controllers\Error#error404',

    'admin' => '\Controllers\AdminController#index',
    '' => '\Controllers\AdminController#index',
];
