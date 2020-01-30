<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
use Bitrix\Main\Page\Asset;
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="ru">
<!--<![endif]-->

<head>
    <?
        if($APPLICATION->GetCurPage(true)==='/index.php')
             Asset::getInstance()->addString('<meta name="yandex-verification" content="213a02d60cd76f47" />
<meta name="google-site-verification" content="CsOLZPrxcKwI4AsAKrE6CEilYXIJ8Op999RKMrxWviw" />')
       ?>
    <? Asset::getInstance()->addString('<!-- Yandex.Metrika counter -->
<script type="text/javascript" data-skip-moving="true">
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(51962558, "init", {
        id:51962558,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/51962558" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->')?>
    <?$APPLICATION->ShowHead();?>

    <title><?$APPLICATION->ShowTitle()?></title>


    <? Asset::getInstance()->addString('<meta http-equiv="X-UA-Compatible" content="IE=edge">')?>
    <? Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">')?>



    <? Asset::getInstance()->addString('<meta name="description" content="" />')?>
    <? Asset::getInstance()->addString('<meta name="keywords" content="" />')?>
    <? Asset::getInstance()->addString('<meta name="robots" content="" />')?>
    <? Asset::getInstance()->addString('<meta name="author" content="" />')?>
    <? Asset::getInstance()->addString('<meta name="designer" content="" />')?>
    <? Asset::getInstance()->addString('<link rel="alternate" href="" hreflang="en" />')?>
    <? Asset::getInstance()->addString('<link rel="alternate" href="" hreflang="fr" />')?>

    <!-- Facebook -->
    <? Asset::getInstance()->addString('<meta property="og:title" content="title" />')?>
    <? Asset::getInstance()->addString('<meta property="og:site_name" content="site_name" />')?>
    <? Asset::getInstance()->addString('<meta property="og:description" content="description" />')?>
    <? Asset::getInstance()->addString('<meta property="og:url" content="url" />')?>
    <? Asset::getInstance()->addString('<meta property="og:image" content="image" />')?>
    <? Asset::getInstance()->addString('<meta property="og:type" content="website" />')?>

    <!-- Google Plus -->
    <? Asset::getInstance()->addString('<meta itemprop="name" content="name" />')?>
    <? Asset::getInstance()->addString('<meta itemprop="description" content="description" />')?>
    <? Asset::getInstance()->addString('<meta itemprop="image" content="image" />')?>

    <!-- Twitter -->
    <? Asset::getInstance()->addString('<meta name="twitter:card" content="card" />')?>
    <? Asset::getInstance()->addString('<meta name="twitter:title" content="title" />')?>
    <? Asset::getInstance()->addString('<meta name="twitter:description" content="description" />')?>
    <? Asset::getInstance()->addString('<meta name="twitter:site" content="@site" />')?>
    <? Asset::getInstance()->addString('<meta name="twitter:creator" content="@creator" />')?>
    <? Asset::getInstance()->addString('<meta name="twitter:url" content="url" />')?>
    <? Asset::getInstance()->addString('<meta name="twitter:image" content="image" />')?>

    <!-- Favicons -->
    <? Asset::getInstance()->addString("<link rel='apple-touch-icon' sizes='57x57' href=".SITE_TEMPLATE_PATH."/img/favicon/apple-icon-48x48.png>")?>
    <? Asset::getInstance()->addString("<link rel='apple-touch-icon' sizes='57x57' href=".SITE_TEMPLATE_PATH."/img/favicon/apple-icon-36x36.png>")?>
    <? Asset::getInstance()->addString("<link rel='apple-touch-icon' sizes='57x57' href=".SITE_TEMPLATE_PATH."/img/favicon/apple-icon-57x57.png>")?>
    <? Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="60x60" href="'.SITE_TEMPLATE_PATH.'img/favicon/apple-icon-60x60.png">')?>
    <? Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="72x72" href="'. SITE_TEMPLATE_PATH.'/img/favicon/apple-icon-72x72.png">')?>
    <? Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="76x76" href="'.  SITE_TEMPLATE_PATH.'img/favicon/apple-icon-76x76.png">')?>
    <? Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="114x114" href="'.  SITE_TEMPLATE_PATH.'/img/favicon/apple-icon-114x114.png">')?>
    <? Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="120x120" href="'.  SITE_TEMPLATE_PATH.'/img/favicon/apple-icon-120x120.png">')?>
    <? Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="144x144" href="'.  SITE_TEMPLATE_PATH.'/img/favicon/apple-icon-144x144.png">')?>
    <? Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="180x180" href="'.  SITE_TEMPLATE_PATH.'/img/favicon/apple-icon-180x180.png">')?>
    <? Asset::getInstance()->addString("<link rel='apple-touch-icon' sizes='57x57' href=".SITE_TEMPLATE_PATH."/img/favicon/apple-icon.png>")?>
    <? Asset::getInstance()->addString('<link rel="icon" type="image/png" href="'. SITE_TEMPLATE_PATH.'/img/favicon/favicon-16x16.png" sizes="16x16">')?>
    <? Asset::getInstance()->addString('<link rel="icon" type="image/png" href="'. SITE_TEMPLATE_PATH.'/img/favicon/favicon-32x32.png" sizes="32x32">')?>
    <? Asset::getInstance()->addString('<link rel="icon" type="image/png" href="'. SITE_TEMPLATE_PATH.'/img/favicon/favicon-96x96.png" sizes="96x96">')?>
    <? Asset::getInstance()->addString('<link rel="icon" type="image/png" href="'. SITE_TEMPLATE_PATH.'/img/favicon/android-icon-192x192.png" sizes="192x192">')?>
    <? Asset::getInstance()->addString('<link rel="icon" type="image/png" href="'. SITE_TEMPLATE_PATH.'/img/favicon/apple-icon-precomposed.png">')?>
    <? Asset::getInstance()->addString('<link rel="manifest" href="'. SITE_TEMPLATE_PATH.'/img/favicon/manifest.json">')?>
    <? Asset::getInstance()->addString('<link rel="shortcut icon" href="'.  SITE_TEMPLATE_PATH.'/img/favicon/favicon.ico">')?>
    <? Asset::getInstance()->addString('<meta name="msapplication-TileColor" content="#ffffff">')?>
    <? Asset::getInstance()->addString('<meta name="msapplication-TileImage" content="'. SITE_TEMPLATE_PATH.'/img/favicon/ms-icon-70x70.png">')?>
    <? Asset::getInstance()->addString('<meta name="msapplication-TileImage" content="'. SITE_TEMPLATE_PATH.'/img/favicon/ms-icon-144x144.png">')?>
    <? Asset::getInstance()->addString('<meta name="msapplication-TileImage" content="'. SITE_TEMPLATE_PATH.'/img/favicon/ms-icon-150x50.png">')?>
    <? Asset::getInstance()->addString('<meta name="msapplication-TileImage" content="'. SITE_TEMPLATE_PATH.'/img/favicon/ms-icon-310x310.png">')?>
    <? Asset::getInstance()->addString('<meta name="theme-color" content="#ffffff">')?>

     <? Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/main.css');?>
     <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/common.bundle.js")?>
</head>

<body data-home>
<?$APPLICATION->ShowPanel()?>
<header>
    <div class="container">
        <div class="row">
            <div class="col-6 col-sm-5 col-md-6 col-lg-6 col-xl-5">
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
                <div class="box__course-itembox">
                    <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"schedule_near_lessons", 
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
		"CHECK_DATES" => "N",
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
		"IBLOCK_ID" => "9",
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
		"PROPERTY_CODE" => array(
			0 => "DAY",
			1 => "REPEAT",
			2 => "PRICE",
			3 => "COURSE",
			4 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "DATE_ACTIVE_TO",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "schedule_near_lessons"
	),
	false
);?>
                    </div>
            </div>
            <div class="col-2 col-lg-2 order-2 col-xl-2 order-xl-1">
                <div class="box__nav-open" data-nav-open></div>
            </div>
            <div class="col-4 col-sm-5 col-md-4 col-lg-4 order-1 col-xl-5 order-xl-2 text-right">
                <?$APPLICATION->IncludeComponent(
                    "Person:social",
                    "",
                    Array()
                );?>
            </div>
        </div>
    </div>
</header>
