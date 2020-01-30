<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Main\Localization\Loc;
?>
<div class="box__popup" data-course>
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
                        <form method="post" action="<?= $this->GetFolder() ?>/ajax.php" name="course">
						<div class="row">
							<div class="col-12"><h2><?= Loc::getMessage('___1TITLE')?></h2></div>
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
                                        "PATH" => SITE_TEMPLATE_PATH . "/include/lang/ru/inc_input_phone_form.php"
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
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:news.list",
                                    "list_course_form",
                                    Array(
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
                                        "FIELD_CODE" => array("", ""),
                                        "FILTER_NAME" => "",
                                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                        "IBLOCK_ID" => "3",
                                        "IBLOCK_TYPE" => "type_course",
                                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                        "INCLUDE_SUBSECTIONS" => "Y",
                                        "MESSAGE_404" => "",
                                        "NEWS_COUNT" => "",
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
                                        "PROPERTY_CODE" => array("PRICE", ""),
                                        "SET_BROWSER_TITLE" => "Y",
                                        "SET_LAST_MODIFIED" => "N",
                                        "SET_META_DESCRIPTION" => "Y",
                                        "SET_META_KEYWORDS" => "Y",
                                        "SET_STATUS_404" => "N",
                                        "SET_TITLE" => "N",
                                        "SHOW_404" => "N",
                                        "SORT_BY1" => "ACTIVE_FROM",
                                        "SORT_BY2" => "SORT",
                                        "SORT_ORDER1" => "DESC",
                                        "SORT_ORDER2" => "ASC",
                                        "STRICT_SECTION_CHECK" => "N"
                                    )
                                );?>
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
                                );?>							</div>
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
