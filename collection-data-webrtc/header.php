<!DOCTYPE HTML>
<html>
<head>
    <title>Diplom-alpha</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="/assets/css/main.css" >
    <?switch ($_SERVER['REQUEST_URI']):
        case '/pages/snapshot.php':?>
            <link rel="stylesheet" href="/assets/css/snapshot.css" >
            <? break;?>
          <?  case '/pages/htmlCapture.php':?>
            <link rel="stylesheet" href="/assets/css/htmlCapture.css" >
            <? break;?>
        <?  case '/pages/snapshotFaceDetect.php':?>
            <link rel="stylesheet" href="/assets/css/snapshotFaceDetect.css" >
            <? break;?>
        <?  case '/pages/snapshotFaceDetectHidden.php':?>
            <link rel="stylesheet" href="/assets/css/snapshotFaceDetectHidden.css" >
            <? break;?>
        <?endswitch;?>
    <noscript><link rel="stylesheet" href="/assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">

<!-- Page Wrapper -->
<div id="page-wrapper">

    <!-- Header -->
    <header id="header" class="alt">
        <h1><a <?= ($_SERVER['REQUEST_URI']=='/')?'':'href="/"'; ?> >Diplom-alpha</a></h1>
        <nav>
            <a href="#menu">Menu</a>
        </nav>
    </header>

    <!-- Menu -->
    <nav id="menu">
        <div class="inner">
            <h2>Menu</h2>
            <ul class="links">
                <li><a  <?= ($_SERVER['REQUEST_URI']=='/')?'':'href="/"'; ?>>Home</a></li>
                <li><a href="/pages/snapshot.php">Snapshot</a></li>
                <li><a href="/pages/snapshotFaceDetect.php">Snapshot face detect</a></li>
                <li><a href="/pages/snapshotFaceDetectHidden.php">Snapshot face detect hidden</a></li>
                <li><a href="/pages/htmlCapture.php">HTML5 Capture Media API</a></li>
                <?/*
								<li><a href="elements.html">Elements</a></li>
								<li><a href="#">Log In</a></li>
								<li><a href="#">Sign Up</a></li>*/?>
            </ul>
            <a href="#" class="close">Close</a>
        </div>
    </nav>


