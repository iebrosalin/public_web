<?
session_start();
require_once("api/src/layout/header.php");
require_once("api/vendor/autoload.php");
?>
    <main class="container">


                <? \Controller\User::app() ?>
    </main>
<? require_once("api/src/layout/footer.php") ?>