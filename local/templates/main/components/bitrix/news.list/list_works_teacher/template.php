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
use  Bitrix\Main\Localization\Loc;

if(0 >= count($arResult ["ITEMS"])) return;

//?>

<section class="box__works box__works-photo">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="box_info">
                            <h2>Работы преподавателя</h2>
                             <div class="box__tabs">
        <ul>
        	<li class="active" data-tab="1" >Все курсы</li>
 <? $i = 2;
 		
                foreach ($arResult["NAME_SECTION"] as $keySection=>$section): ?>
                    <? if(isset($section['UF_HIGHLIGHT'])):?>
                    <li  data-tab="<?= $i ?>" ><span class="box__course-free"><?= $section ['NAME'] ?></span></li>
                    <?else:?>
                    <li data-tab="<?=  $i ?>" ><?= $section ['NAME'] ?></li>
                    <?endif;?>
                <? ++$i; endforeach; ?>
        </ul>
    </div>
    <div class="box__text" data-workscarusel-text></div>
</div>

<div class="box__works-carusel active" data-tab-item="1">
        <? foreach ($arResult["ITEMS"] as $keyItem=>$arItem): ?>
            <img id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
                 src="<?= existImageFile($arItem['PREVIEW_PICTURE'] ['SRC']) ?>"
                 alt="<?= $arItem['NAME'] ?>" data-caption="<?= htmlspecialcharsback($arItem['PREVIEW_TEXT']) ?>">
        <? endforeach; ?>
</div>

<? $i = 2;
foreach ($arResult['NAME_SECTION'] as $keySection=> $section): ?>
    <? if ($i == 2): ?>
    <div class="box__works-carusel" data-tab-item="2">
        <? foreach ($arResult["ITEMS"] as $keyItem=>$arItem): ?>
            <? if($arItem['IBLOCK_SECTION_ID']==$keySection):?>
            <img id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
                 src="<?= existImageFile($arItem['PREVIEW_PICTURE'] ['SRC']) ?>"
                 alt="<?= $arItem['NAME'] ?>" data-caption="<?= htmlspecialcharsback($arItem['PREVIEW_TEXT']) ?>">
            <? unset($arResult ['ITEMS'] [$keyItem]);
                endif;?>
        <? endforeach; ?>
    </div>
    <? else: ?>
    <div class="box__works-carusel" data-tab-item="<?= $i ?>">
        <? foreach ($arResult["ITEMS"] as $keyItem=>$arItem): ?>
            <? if($arItem['IBLOCK_SECTION_ID']==$keySection):?>
                <img <?/*id="<?= $this->GetEditAreaId($arItem['ID']); ?>"*/?>
                     src="<?= existImageFile($arItem['PREVIEW_PICTURE'] ['SRC']) ?>"
                     alt="<?= $arItem['NAME'] ?>" data-caption="<?= htmlspecialcharsback($arItem['PREVIEW_TEXT']) ?>">
                <? unset($arResult ['ITEMS'] [$keyItem]);
            endif;?>
        <? endforeach; ?>
        </div>
    <? endif; ?>
<? ++$i;
endforeach; ?>
                        </div>
                    </div>
                </div>
        </section>


