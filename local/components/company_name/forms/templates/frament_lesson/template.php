<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}?>
<div class="box__subsform">
    <form name="fragment_lesson"  method="post" action="<?= $this->GetFolder() ?>/ajax.php">
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
        <input type="hidden" name='iblock_id' value="<?=$arParams['IBLOCK_ID']?>">
    </form>
</div>