<?php

use Components\Helpers\Helpers;

?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cutted-admin panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/minty/bootstrap.min.css" rel="stylesheet" integrity="sha384-9NlqO4dP5KfioUGS568UFwM3lbWf3Uj3Qb7FBHuIuhLoDp3ZgAqPE1/MYLEBPZYM" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<style>
    .btn, .btn:hover {
        color: #888888;
    }

    .btn.btn-primary,
    a.list-group-item.active:hover,
    a.list-group-item.active {
        color: #ffffff ;
    }
</style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
        <a class="navbar-brand" href="">Slim admin panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item
                <?= (isHome())?'active':'' ?>">
                    <a class="nav-link" href="/admin">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item
                <?= ( partUriMatch('/admin/product') )?'active':'' ?>
                    ">
                    <a class="nav-link" href="/admin/product/">Products</a>
                </li>
                <li class="nav-item
                <?= (  partUriMatch('/admin/category') )?'active':'' ?>
                ">
                    <a class="nav-link" href="/admin/category/">Category</a>
                </li>
                <li class="nav-item
                <?= (  partUriMatch('/admin/echo-request') )?'active':'' ?>
                ">
                    <a class="nav-link" href="/admin/echo-request/">Echo-request</a>
                </li>
            </ul>
        </div>
        </div>
    </nav>
</header>
<div class="container">
    <div class="row">
    <div class="col">
     <?if(notHome()):?>
    <?= Helpers::renderBreadcrumb()?>
        <? endif;?>
