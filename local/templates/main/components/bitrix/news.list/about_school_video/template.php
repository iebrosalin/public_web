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

?>
<? //p_f($arResult);
$arItem=$arResult["ITEMS"][0]?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	?>


        <div  id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="box__video"
              style="background-image: url(<?=  existImage($arItem ['PROPERTIES'] ['POSTER'] ['VALUE'])?>)"
              data-boxvideo data-video="<?=  $arItem ['PROPERTIES'] ['VIDEO'] ['VALUE']?>">
    </div>

