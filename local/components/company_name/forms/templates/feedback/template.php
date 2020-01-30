<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
//p_f(explode('/',$APPLICATION->GetCurDir())[1]);
use \Bitrix\Main\Localization\Loc;
?>

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="box__form">
                    <form name="feedback"  method="post" action="<?= $this->GetFolder() ?>/ajax.php">
                    <h2><?= (explode('/',$APPLICATION->GetCurDir())[1]=="teachers"?Loc::getMessage('TITLE_TEACHER'):Loc::getMessage('TITLE'))?></h2>
                    <div class="box__description">
                        <?= Loc::getMessage('DESC')?>
                    </div>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/lang/ru/inc_input_name_form.php"
                            )
                        ); ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/lang/ru/inc_input_phone_form.php"
                            )
                        ); ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/lang/ru/inc_input_email_form.php"
                            )
                        ); ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/lang/ru/inc_input_feedback_text_form.php"
                            )
                        ); ?>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <?$APPLICATION->IncludeComponent(
                                    "Person:href_policy",
                                    "",
                                    Array(
                                        "CACHE_TIME" => "86400",
                                        "CACHE_TYPE" => "A",
                                        "IBLOCK_ID" => "1",
                                        "IBLOCK_TYPE" => "about_Person"
                                    )
                                );?>
                            </div>
                            <div class="col-12 col-md-6 text-right">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH . "/include/lang/ru/inc_btn_submit_form.php"
                                    )
                                ); ?>
                            </div>
                        </div>

                        <input type="hidden" name='iblock_id' value="<?=$arParams['IBLOCK_ID']?>">
                    </form>
                </div>
            </div>
            <div class="col-12 d-none d-lg-block offset-lg-1 col-lg-6">
                <div class="box__image-right"
                     style="background-image: url(<?= SITE_TEMPLATE_PATH ?>/img/image/image_form-right.jpg)"></div>
            </div>
        </div>
    </div>