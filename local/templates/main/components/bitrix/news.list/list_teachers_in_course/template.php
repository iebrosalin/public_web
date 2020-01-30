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
//?>
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
                    "PATH" => SITE_TEMPLATE_PATH."/include/lang/ru/inc_title_block_teacher_course.php"
                )
            );?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="box__items-all">
                <div class="row">
                    <?

                    foreach ($arResult["ITEMS"] as $arItem):

                        if(in_array($arItem['ID'], $arParams['LIST'])):
                     ?>
                    <div class="col-12 col-xl-6">
                        <div class="box__item">
                            <div class="box__image" style="background-image: url(<?= $arItem ['PREVIEW_PICTURE']['SRC'] ?>)">
                                <video preload="auto" loop="" muted="muted" volume="0" style="background: <?= existImageFile($arItem ['PREVIEW_PICTURE']['SRC']) ?>;"
                                       poster="<?= existImageFile($arItem ['PREVIEW_PICTURE']['SRC']) ?>"
                                       src="<?= $arItem ['PROPERTIES'] ['HREF'] ['VALUE']?>"
                                       autoplay="autoplay"></video>
                            </div>
                            <div class="box__info-teachers">
                                <h3><?= $arItem ['NAME'] ?></h3>
                                <div class="box__description"><?= $arItem['PROPERTIES'] ['SIGN_L']['~VALUE']  ['TEXT'] ?></div>
                                <div class="box__link"><a href=" <?= $arItem ['DETAIL_PAGE_URL'] ?>"><?= Loc::getMessage("DETAIL")?></a></div>
                            </div>
                        </div>
                    </div>

                    <? endif;
                    endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>



