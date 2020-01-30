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

//?>
<div class="box__itembox">
    <ul>
        <?foreach($arResult["ITEMS"] as $keyItem=>$arItem):?>
            <? if($arParams ["CHOOSE_SECTION"]==$arItem['IBLOCK_SECTION_ID']):?>
                <li>
                    <span class="box__number-training" style="background-image: url(<?= existImage($arItem['PROPERTIES'] ['ICON']['VALUE']);?>)"></span>
                    <h3><?= $arItem ['NAME'];?></h3>
                </li>
                <? unset($arResult["ITEMS"] [$keyItem]);
                else:
                    unset($arResult["ITEMS"] [$keyItem]);
                    continue;
                endif; ?>
    <?endforeach;?>
    </ul>
</div>