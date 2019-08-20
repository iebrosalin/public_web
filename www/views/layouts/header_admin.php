<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cutted-admin panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/minty/bootstrap.min.css" rel="stylesheet" integrity="sha384-9NlqO4dP5KfioUGS568UFwM3lbWf3Uj3Qb7FBHuIuhLoDp3ZgAqPE1/MYLEBPZYM" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="">Cutted-admin panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item
                <?
                echo ($_SERVER['REQUEST_URI']==='/' || $_SERVER['REQUEST_URI']==='/admin' || $_SERVER['REQUEST_URI']==='/admin.')?'active':'' ?>">
                    <a class="nav-link" href="/admin">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/product/">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/category/">Category</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Header End====================================================================== -->
<div class="container">
    <div>
        <div class="row">
