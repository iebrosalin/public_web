<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);
//p_f($arResult);
define('COUNT_ELEMENT_IN_SET',6); //Кол-во подгружаемых элементов
use Bitrix\Main\Localization\Loc;
//?>
<?
//p_f($arResult);
if( count( $arResult["ITEMS"])!=0):?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => SITE_TEMPLATE_PATH."/include/lang/ru/inc_title_course_schedule_table.php"
                )
            );?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="box__table-schedule">
                <ul>
                    <li class="title">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH."/include/lang/ru/inc_title_schedule_table.php"
                            )
                        );?>
                    </li>
                    <? $count_el=0; $id_iblock;$id_course;
                    foreach($arResult["ITEMS"] as $key=>$arItem):
$arTime=explode('.',explode (' ',$arItem["DATE_ACTIVE_TO"])[0]);
                            if( date('j', time())<=intval($arTime[0]) && date('n', time())==intval($arTime[1])) continue;
                        ?>
                            <li>
                                <span class="btn__close"></span>
                                <ul>
                                    <li>
                                        <div class="box__date-schedule"><i><?= intval($arTime[0])?></i>
                                            <span class="wrapper-dates">
                                                <?= $arResult['MONTHS'] [intval($arTime[1])]?>
                                            <span><?= $arTime[2]?></span>
                                                </span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="box__course-schedule"><a href="<?= $arItem ['DISPLAY_PROPERTIES']['COURSE']['LINK_ELEMENT_VALUE']
                                            [$arItem ['DISPLAY_PROPERTIES']['COURSE']['VALUE']] ['DETAIL_PAGE_URL']?>">
                                                <?= strTokDot($arItem ['DISPLAY_PROPERTIES']['COURSE']['LINK_ELEMENT_VALUE']
                                                [$arItem ['DISPLAY_PROPERTIES']['COURSE']['VALUE']] ['NAME'],LEN_TITLE_COURSE_SCHEDULE)
                                                ?>
                                                <span><?= $arItem ['COURSE_LEVEL'] ?>     </span></a></div>
                                    </li>
                                    <li>
                                        <?= htmlspecialcharsback($arItem ['PROPERTIES']['DAY']['VALUE'] ['TEXT'])?>
                                    </li>
                                    <li>
                                        <div class="box__price-schedule">
                                            <div class="box__title-hidden"><?= Loc::getMessage('PRICE')?></div>
                                            <?= $arItem ['PRICE_COURSE'] ?>
                                        </div>
                                    </li>
                                    <li>

                                        <div class="btn" data-course-open data-course-id="<?=$arItem ['DISPLAY_PROPERTIES']['COURSE']['VALUE']?>"><button>Записатся</<button></div>
                                    </li>
                                </ul>
                            </li>
                        <?

                        ++$count_el;
                        $id_course=$arItem ['DISPLAY_PROPERTIES']['COURSE']['VALUE'];
                        $id_iblock=$arItem ['DISPLAY_PROPERTIES']['COURSE']['LINK_ELEMENT_VALUE'] [$arItem ['DISPLAY_PROPERTIES']['COURSE']['VALUE']] ['IBLOCK_ID'];
                        if($count_el==COUNT_ELEMENT_IN_SET) break;
                    endforeach;?>
                </ul>
            </div>
        </div>
    </div>
    <? if(count($arResult['ITEMS'])>COUNT_ELEMENT_IN_SET):?>
    <div class="row">
        <div class="col-12">
            <form method="post" action="<?= $this->GetFolder() ?>/ajax.php" name="schedule_course_more">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => SITE_TEMPLATE_PATH."/include/lang/ru/inc_btn_schedule_table.php"
                    )
                );?>
                <input type="hidden" name="iblock_id" value="<?=$arParams["IBLOCK_ID"]?>">
                <input type="hidden" name="course_iblock_id" value="<?=$id_iblock?>">
                <input type="hidden" name="course_id" value="<?=$id_course?>">
            </form>
        </div>
    </div>
    <? endif;?>
</div>
<?else: ?>
    <div class="container">
    <div class="row">
    <div class="col-12">
    <?$APPLICATION->IncludeComponent(
"bitrix:main.include",
"",
Array(
"AREA_FILE_SHOW" => "file",
"AREA_FILE_SUFFIX" => "inc",
"EDIT_TEMPLATE" => "",
"PATH" => SITE_TEMPLATE_PATH."/include/lang/ru/inc_no_lessons_in schedule.php"
)
);?>
    </div>
    </div>
    </div>
<? endif; ?>