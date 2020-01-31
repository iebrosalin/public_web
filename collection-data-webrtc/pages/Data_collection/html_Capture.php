<? require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Main/load.php');

use App\Main\Helper as Helper;
use App\Main\App as App;

require_once (App::HEADER); ?>

<section id="wrapper">
    <header>
        <div class="inner">
            <h2>HTML5 Capture Media API</h2>
            <p>Получение данных с устройства средствами HTML5 Capture Media API.</p>
        </div>
    </header>

    <!-- Content -->
    <div class="wrapper" >
        <? if(get_browser(null, true)['tables'] ==1):?>
        <div class="inner"   style="text-align:center !important;">
               <?/* <div class="form-group">
                    <input type="file" name="file-audio" id="file-audio" accept="audio/*" capture="" class="input-file">
                    <label for="file-audio" class="btn btn-tertiary js-labelFile">
                        <i class="icon fa fa-microphone"></i>
                        <span class="js-fileName">Записать аудиозапись</span>
                    </label>
            </div>
                <div class="form-group">
                    <input type="file" name="file-video" id="file-video" accept="video/*" capture="user" class="input-file">
                    <label for="file-video" class="btn btn-tertiary js-labelFile">
                        <i class="icon fa fa-video-camera"></i>
                        <span class="js-fileName">Записать видео</span>
                    </label>
                </div>*/?>
                <div class=" form-group">
                    <h3 class="major">Захват изображения с камеры телеофна</h3>
                    <p>Превью</p>
                    <img id="preview" class="img-responsive" src="/images/emptyImage.jpg" title="preview">
                    <form name="capture-image" action="/ajax.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="file-images" id="file-image" accept="image/*" capture="user" class="input-file">
                    <label for="file-image" class="btn btn-tertiary js-labelFile">
                        <i class="icon fa fa-camera"></i>
                        <span class="js-fileName">Сделать фотографию</span>
                    </label>
                    </form>
                </div>
            <p>Результат</p>
            <img id="screenshot-img" class="img-responsive" src="/images/emptyImage.jpg">
            <p id="result"></p>
        </div>
        <? else:?>
            <div class="inner">
                <h3 class="major">Упс! Что-то пошло не так...</h3>
                <p>HTML5 Capture Media API на настольных компьютерах не позволяет увидеть интересующий функционал.
                    Зайдите с мобильного телефона, чтобы увидеть функционал.</p>
            </div>
        <? endif;?>
       <?/* <div class="inner">
            <? require_once ($_SERVER['DOCUMENT_ROOT']."/pages/pagesBlock.php");?>
    </div>*/?>

</section>

<? require_once (App::FOOTER); ?>
