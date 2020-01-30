<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
    <div class="row">
        <div class="col-6 col-lg-6 col-md-6 col-xs-12">
            <h2>Расписание в процессе наполнения<?="\xf0\x9f\x98\x8a"?></h2>
            <p>В данный момент идёт формирование нового расписания. Вы можете оставить заявку на прохождение одного из курсов</p>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => SITE_TEMPLATE_PATH."/include/lang/ru/inc_btn_sign_course.php"
                )
            );?>
        </div>
    </div>
