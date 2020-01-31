<? require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Main/load.php');

use App\Main\Helper as Helper;
use App\Main\App as App;

require_once (App::HEADER); ?>

<!-- Wrapper -->
<section id="wrapper">
    <header>
        <div class="inner">
            <h2>Snapshot face detect</h2>
            <p>Получение изображения с вебкамеры и обнаружение лица.</p>
        </div>
    </header>

    <!-- Content -->
    <div class="wrapper">
        <div class="inner">
            <div id="screenshot" style="text-align:center;">
                <h3 class="major">Видео</h3>
                <video class="videostream" autoplay poster="/images/emptyImage.jpg"></video>
                <p><button class="capture-button">Вывети видеопоток</button></p>
                <p><button id="screenshot-button" disabled="">Отправить на обработку</button></p>
                <h3 class="major">Результат обнаружения</h3>
                <img id="screenshot-img" class="img-responsive" src="/images/emptyImage.jpg" data-src style="display:none;">
                <img id="screenshot-img" class="img-responsive" src="/images/emptyImage.jpg" data-show>
                <p id="result"></p>
            </div>

            <? require_once ($_SERVER['DOCUMENT_ROOT']."/pages/pagesBlock.php");?>
        </div>
    </div>
</section>

<? require_once (App::FOOTER);;?>
