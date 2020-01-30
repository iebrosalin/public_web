<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */

/** @var CBitrixComponent $component */
use Bitrix\Main\Localization\Loc;

//$this->setFrameMode(true); //p_f($arResult);
?>
<main>
    <? if (isset($arResult ['NAME'])): ?>
        <section class="box__head-taecher"
                 style=" background-image: url(<?= existImage($arResult ['PROPERTIES'] ['BACKGROUND_IMAGE'] ['VALUE']) ?>);">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="box__image"
                             style='background-image: url(<?= existImageFile($arResult ['DETAIL_PICTURE'] ['SRC']) ?>);'></div>
                        <h1><?= $arResult ['NAME'] ?>
                            <span><?= htmlspecialcharsback( $arResult['PROPERTIES'] ['SIGN_D']['VALUE']  ['TEXT'] ) ?></span></h1>
                    </div>
                </div>
            </div>
        </section>
    <? endif; ?>
    <? if (isset($arResult ['PROPERTIES'] ['BIO'] ['VALUE'] ['TEXT'])): ?>
        <section class="box__teacher-description">
            <div class="container">
                <div class="row">
                    <?= htmlspecialcharsback($arResult ['PROPERTIES'] ['BIO'] ['VALUE'] ['TEXT']) ?>
                </div>
            </div>
        </section>
    <? endif; ?>
    <? if (isset($arResult ['PROPERTIES'] ['HRONO'] ['VALUE'] ['TEXT'])): ?>
        <section class="box__timeline">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?= htmlspecialcharsback($arResult ['PROPERTIES'] ['HRONO'] ['VALUE'] ['TEXT']) ?>
                    </div>
                </div>
            </div>
        </section>
        </section>
    <? endif; ?>
    <? if (is_array($arResult ['PROPERTIES'] ['SERTIFICATION'] ['VALUE'])): ?>
        <section class="box__sertificate">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2><?= Loc::getMessage('SERTIFICATION') ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="box__sertificate-owlcarusel owl-carousel">
                            <? foreach ($arResult ['PROPERTIES'] ['SERTIFICATION'] ['VALUE'] as $img): ?>
                                <div class="item"><img src="<?= existImage($img) ?>" alt=""></div>
                            <? endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    <? endif; ?>
    <? if (isset($arResult ['PROPERTIES'] ['WORKS'] ['VALUE'])): ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "list_works_teacher",
            Array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "N",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array("NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", ""),
                "PROPERTY_CODE" => array("", "  UF_HIGHLIGHT", ""),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "25",
                "IBLOCK_TYPE" => "teachers",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "9999",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => $arResult ['PROPERTIES'] ['WORKS'] ['VALUE'],
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array("", ""),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "SORT",
                "SORT_BY2" => "NAME",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N"
            )
        ); ?>
    <? endif; ?>

    <?
    if (isAjax() || isset($arParams["CLIENT_DATA"])) {
        $APPLICATION->RestartBuffer();
        $template = "list_course_teacher-ajax";
    }
    else {
        $template = "list_course_teacher";
    }
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        $template,
        array(
            "LIST" => $arResult["PROPERTIES"]["COURSE"]["VALUE"],
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "N",
            "DISPLAY_NAME" => "N",
            "DISPLAY_PICTURE" => "N",
            "DISPLAY_PREVIEW_TEXT" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(
                0 => "NAME",
                1 => "PREVIEW_TEXT",
                2 => "PREVIEW_PICTURE",
                3 => "",
            ),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "3",
            "IBLOCK_TYPE" => "type_course",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "99999",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(
                0 => "LEVEL",
                1 => "",
            ),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "TIMESTAMP_X",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N",
            "COMPONENT_TEMPLATE" => "list_course_teacher",
            "TEACHER_ID" => $arResult ['ID'],
            "CUR_COUNT_ELEM"=>$arParams["CLIENT_DATA"] ['count_elems'],
        ),
        false
    ); ?>
    <? if ( isAjax() || isset($arParams["CLIENT_DATA"] ) ) {
        die();
    } ?>

    <section class="box__feedback">
        <? $APPLICATION->IncludeComponent(
            "Person:forms",
            "feedback",
            array(
                "COMPONENT_TEMPLATE" => "feedback",
                "IBLOCK_TYPE" => "forms",
                "IBLOCK_ID" => "22",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "86400"
            ),
            false
        ); ?>
    </section>

</main>