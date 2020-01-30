<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Main\Localization\Loc;
?>
<div class="box__popup" data-message>
    <span class="box__bg-right"></span>
    <div class="container">
        <div class="wrapper-content">
            <div class="row">
                <div class="col-12">
                    <div class="box__header">
                        <div class="box__logo">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => SITE_TEMPLATE_PATH . "/include/lang/ru/inc_logo.php"
                                )
                            ); ?>

                        </div>
                        <div class="btn__close" style="background-image: url(<?= SITE_TEMPLATE_PATH?>/img/icon/x_menu.svg)" data-popup-close></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="box__form">
                        <form method="post" action="<?= $this->GetFolder() ?>/ajax.php" name="reviews">
                        <div class="row">
                            <div class="col-12"><h2><?= Loc::getMessage('_TITLE')?></h2></div>
                        </div>
                        <div class="row">
                            <div class="col-12">
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH . "/include/lang/ru/inc_input_reviews_text_form.php"
                                    )
                                ); ?>
                            </div>
                        </div>
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
                                );?>                            </div>
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
            </div>
        </div>
    </div>
</div>