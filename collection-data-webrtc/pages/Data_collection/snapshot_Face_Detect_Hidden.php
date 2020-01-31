<? require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Main/load.php');

use App\Main\Helper as Helper;
use App\Main\App as App;

require_once (App::HEADER); ?>

<!-- Wrapper -->
<section id="wrapper">
    <header>
        <div class="inner">
            <h2>Snapshot face detect hidden</h2>
            <p>Получение изображения с вебкамеры и обнаружение лица скрытым способом.</p>
        </div>
    </header>

    <!-- Content -->
    <div class="wrapper">
        <div class="inner">
            <div id="screenshot" style="text-align:center;">
                <video class="videostream" autoplay poster="/images/emptyImage.jpg"  ></video>
                <img id="screenshot-img" class="img-responsive" src="/images/emptyImage.jpg" >
            </div>
            <h3 class="major">Результат скрытой съёмки</h3>
            <div class="row gtr-uniform">
            </div>
            <br><br><br>
            <? require_once ($_SERVER['DOCUMENT_ROOT']."/pages/pagesBlock.php");?>
        </div>
    </div>
</section>

<? require_once (App::FOOTER);;?>
