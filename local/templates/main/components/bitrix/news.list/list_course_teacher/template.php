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
use Bitrix\Main\Localization\Loc;
?>
<section class="box__teacher-author">
<div class="container" >
    <div class="row">
        <div class="col-12"><h2><?= Loc::getMessage('COURSE')?></h2></div>
    </div>
    <div class="row" data-course-teacher>
<?
$count_el=0;
foreach($arResult["ITEMS"] as $arItem):?>
    <? if(in_array($arItem['ID'],$arParams['LIST'])):

       // $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
       // $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    if($count_el<SHOW_COURSE_TEACHER){
        ?>
    <div class="col-12 col-lg-4" >
            <div class="box__item item-animation">
                <a href="<?= $arItem['DETAIL_PAGE_URL']?>" style="background-image: url(<?= existImageFile($arItem['PREVIEW_PICTURE'] ['SRC'])?>)" data-item-wraper-animation>
                    <span class="title" data-item-title-animation><?= $arItem['NAME'] ?></span>
                    <span class="description" data-item-description-animation><?= $arItem['PROPERTIES'] ['LEVEL'] ['VALUE']?></span>
                    <span class="box__logo" data-item-logo-animation style="background-image: url(<?= existImageFile($arResult['NAME_SECTION'] [$arItem['IBLOCK_SECTION_ID']] ['PICTURE'])?>)"></span>
                </a>
            </div>
    </div>
        <? ++ $count_el;
    }
    else {
        ++ $count_el;
        continue;
    }?>
    <? endif;?>
<?endforeach;?>
    </div>
    <?if($count_el>SHOW_COURSE_TEACHER): ?>
        <div class="row">
            <div class="col-12 text-center">
                <form method="post" action="" name="list_course_teacher">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH . "/include/lang/ru/inc_btn_more.php"
                        )
                    ); ?>
                    <input type="hidden" name="iblock_id" value="<?=$arResult['ID']?>">
                    <input type="hidden" name="teacher_id" value="<?=$arParams['TEACHER_ID']?>">
                </form>
            </div>
        </div>
    <? endif;?>
</div>
</section>
