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

if(0 >= count($arResult["CHOOSEN_ITEMS"])) return;
//?>

<div class="box_info">
    <h2><?= Loc::getMessage("TITLE_")?></h2>
<div class="box__tabs">

</div>
<div class="box__text" data-workscarusel-text></div>
</div>

<div class="box__works-carusel active" data-tab-item="1">

   <? foreach ( $arResult["CHOOSEN_ITEMS"] as $keyItem=>$arItem): ?>
        <img
             src="<?= $arItem['PREVIEW_PICTURE'] ['SRC'] ?>"
             alt="<?= $arItem['NAME'] ?>" data-caption="<?= htmlspecialcharsback($arItem['PREVIEW_TEXT']) ?>">
    <? endforeach; ?>
</div>



