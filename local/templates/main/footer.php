<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="box__footer">
                    <?$APPLICATION->IncludeComponent(
                        "Person:Person_reference",
                        "",
                        Array(
                            "CACHE_TIME" => "86400",
                            "CACHE_TYPE" => "A",
                            "IBLOCK_ID" => "1",
                            "IBLOCK_TYPE" => "about_Person"
                        )
                    );?>
                </div>
            </div>
        </div>
    </div>
</footer>


<div class="box__bonus" data-gift-open></div>

<div class="btn__up-top"></div>
<?if($APPLICATION->GetCurPage()=='/'):?>
<div class="box__right-element">
    <ul>
        <li data-item="box__head-home"></li>
        <li data-item="box__about"></li>
        <li data-item="box__course-all"></li>
        <li data-item="box__schedule"></li>
        <li data-item="box__works box__works-photo"></li>
        <li data-item="box__reviews"></li>
        <li data-item="box__works box__works-graduate"></li>
        <li data-item="box__teachers"></li>
        <li data-item="box__feedback"></li>
        <li data-item="box__contact"></li>
        <li data-item="box__head-home" class="btn-up"></li>
    </ul>
</div>
<? endif;?>
<div class="hidden"></div>
<?$APPLICATION->IncludeComponent(
	"Person:forms",
	"reviews", 
	array(
		"COMPONENT_TEMPLATE" => "reviews",
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "23",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "86400"
	),
	false
);?>
<?$APPLICATION->IncludeComponent(
	"Person:forms",
	"gift", 
	array(
		"COMPONENT_TEMPLATE" => "gift",
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "19",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "86400"
	),
	false
);?>
<?$APPLICATION->IncludeComponent(
	"Person:forms",
	"course", 
	array(
		"COMPONENT_TEMPLATE" => "course",
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "21",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "86400"
	),
	false
);?>
<?$APPLICATION->IncludeComponent(
	"Person:forms",
	"callback", 
	array(
		"COMPONENT_TEMPLATE" => "callback",
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "18",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "86400"
	),
	false
);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"menu", 
	array(
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
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "8",
		"IBLOCK_TYPE" => "about_Person",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
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
		"PROPERTY_CODE" => array(
			0 => "HREF",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "menu"
	),
	false
);?>
<div class="box__popup-error" data-error>
    <span class="btn__close-error" data-popup-close></span>
    <div class="wrapper-content">
        <h3>Ошибка запроса</h3>
        <div class="description">Перезагрузите страницу или обратитесь к администратору</div>
    </div>
</div>
<div class="box__popup" data-review>
    <div class="container">
        <div class="wrapper-content">
            <div class="row">
                <div class="col-12">
                    <div class="box__head-popup">
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
                <div class="col-12 offset-lg-1 col-lg-10 offset-xl-2 col-xl-8">
                    <div class="box__person-review">
                        <div class="box__image" data-reviewpopup="image" style="background-image: url(<?= SITE_TEMPLATE_PATH?>/img/image/cover.jpg);"></div>
                        <h3 data-reviewpopup="name">Алексей Тухачевский</h3>
                        <div class="box__description" data-reviewpopup="profile">Студент курса</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 offset-lg-1 col-lg-10 offset-xl-2 col-xl-8">
                    <div class="box__text-review" data-reviewpopup="text">
                        <p>Спасибо огромное за отличный курс!!! Обучалась с огромным удовольствием. Октябрь пролетел незаметно, каждое занятие ждала с нетерпением, чтобы узнать для себя много новой и очень полезной информации. Теперь сама без особого труда могу построить 3-х мерное изображение, подобрать материалы, настроить свет.</p>
                        <p>Person – настоящий профессионал, талантливый преподаватель, грамотно донести сложный материал на простом, доступном языке вызывает восхищение. Спасибо за то, что отвечал на все вопросы, подсказывал по домашнему заданию – твое терпение не знает предела)) Была очень рада знакомству с такими творческими, интересными людьми, на занятиях всегда царила приятная атмосфера, с юмором и хорошим настроением. Благодаря этим курсам снова захотелось творить и развиваться в сфере дизайна.👍</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div data-video-popup data-izimodal-iframeURL></div>

</body>

</html>

