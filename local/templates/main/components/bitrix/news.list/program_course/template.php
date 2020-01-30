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
use Bitrix\Main\Localization\Loc;
$this->setFrameMode(true);
//p_f($arResult);
//?>

<div class="row">
    <div class="col-12">
        <div class="box__items-all">
            <div class="row">
                <?

                foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                    ?>
                    <div class="col-12 col-xl-6" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <div class="box__item">
                            <div class="box__image">
                                <video preload="auto" loop="" muted="muted" volume="0" style="background: none;"
                                       poster="<?= $arItem ['PREVIEW_PICTURE']['SRC'] ?>"
                                       src="<?= $arItem ['PROPERTIES'] ['HREF'] ['VALUE']?>"
                                       autoplay="autoplay"></video>
                            </div>
                            <div class="box__info-teachers">
                                <h3>Person</h3>
                                <div class="box__description"><?= $arItem ['PREVIEW_TEXT'] ?></div>
                                <div class="box__link"><a href=" <?= $arItem ['DETAIL_PAGE_URL'] ?>"><?= Loc::getMessage("DETAIL")?></a></div>
                            </div>
                        </div>
                    </div>

                <? endforeach; ?>
            </div>

        </div>
    </div>
</div>





