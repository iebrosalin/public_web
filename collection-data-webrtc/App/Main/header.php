<?
use App\Main\App as App;
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Diplom-alpha</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="/assets/css/main.css" >
    <?switch ($_SERVER['REQUEST_URI']):
        case '/pages/Data_collection/snapshot.php':?>
            <link rel="stylesheet" href="/assets/css/snapshot.css" >
            <? break;?>
          <?  case '/pages/Data_collection/html_Capture.php':?>
            <link rel="stylesheet" href="/assets/css/html_Capture.css" >
            <? break;?>
        <?  case '/pages/Data_collection/snapshot_Face_Detect.php':?>
            <link rel="stylesheet" href="/assets/css/snapshot_Face_Detect.css" >
            <? break;?>
        <?  case '/pages/Data_collection/snapshot_FaceDetect_Hidden.php':?>
            <link rel="stylesheet" href="/assets/css/snapshot_Face_Detect_Hidden.css" >
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
                <? if($_SERVER['REQUEST_URI']!=='/'):?>
                                <li><a  href="/">Home</a></li>
                <? endif;?>
                <?
                foreach (\App\Main\App::getSection('/pages') as $item):?>
                    <li><a href="/pages/<?=$item?>"><?= $item?></a></li>
                <?endforeach;?>
                <?
                /*
								<li><a href="elements.html">Elements</a></li>
								<li><a href="#">Log In</a></li>
								<li><a href="#">Sign Up</a></li>*/?>
            </ul>
            <a href="#" class="close">Close</a>
        </div>
    </nav>


