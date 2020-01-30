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
$this->setFrameMode(true);
//?>

<div class="box_info">
    <? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "PATH" => SITE_TEMPLATE_PATH . "/include/lang/ru/inc_title_gallery.php"
        )
    ); ?>

    <div class="box__tabs">
        <ul>
            <li class="active" data-tab="1">Все</li>
            <? $i = 2;
            foreach ($arResult['NAME_SECTION'] as $section): ?>
                <? if ($i == 2): ?>
                    <li data-tab="2"><?= $section ?></li>
               <? else:?>
                <li data-tab="<?= $i ?>"><?= $section ?></li>
                <? endif; ?>
                <? ++$i; endforeach; ?>
        </ul>
    </div>
    <div class="box__text" data-workscarusel-text></div>
</div>

<div class="box__works-carusel active" data-tab-item="1">
    <? foreach ($arResult["ITEMS"] as $keyItem=>$arItem): ?>
                <img <?/*id="<?= $this->GetEditAreaId($arItem['ID']); ?>"*/?>
                     src="<?= existImageFile($arItem['PREVIEW_PICTURE'] ['SRC']) ?>"
                     alt="<?= $arItem['NAME'] ?>" data-caption="<?= htmlspecialcharsback($arItem['PREVIEW_TEXT']) ?>">  
    <?endforeach; ?>
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
<!--            --><?//
//            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
//            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
//            ?>
            <? unset($arResult ['ITEMS'] [$keyItem]);
                endif;?>
        <? endforeach; ?>
    <? else: ?>
    <div class="box__works-carusel" data-tab-item="<?= $i ?>">
        <? foreach ($arResult["ITEMS"] as $keyItem=>$arItem): ?>
            <? if($arItem['IBLOCK_SECTION_ID']==$keySection):?>
                <img <?/*id="<?= $this->GetEditAreaId($arItem['ID']); ?>"*/?>
                     src="<?= existImageFile($arItem['PREVIEW_PICTURE'] ['SRC']) ?>"
                     alt="<?= $arItem['NAME'] ?>" data-caption="<?= htmlspecialcharsback($arItem['PREVIEW_TEXT']) ?>">
                <!--            --><?//
//            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
//            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
//            ?>
                <? unset($arResult ['ITEMS'] [$keyItem]);
            endif;?>
        <? endforeach; ?>
    <? endif; ?>
    </div>
<? ++$i;
endforeach; ?>




