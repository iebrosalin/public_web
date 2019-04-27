<?
session_start();
require_once("api/src/layout/header.php");
require_once("api/vendor/autoload.php");
?>
    <main class="container">

        <!--            <div class="wrapper-preloader">-->
        <!--                <div class="lds-facebook"><div></div><div></div><div></div></div></div>-->

        <!--        <div class="row">-->
        <!--            <div class="col-12">-->
        <!--                <h3></h3>-->
        <!--            </div>-->
        <!--        </div>-->

                <? \Controller\User::app() ?>
    </main>
<? require_once("api/src/layout/footer.php") ?>