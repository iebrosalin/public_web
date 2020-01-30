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
//p_f($arResult);
?>


<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => SITE_TEMPLATE_PATH."/include/lang/ru/inc_title_course_speciality.php"
                )
            );?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
        <div class="box__tabs">
            <ul>
                <? $i=1; foreach($arResult["ITEMS"] as $arItem):?>
                    <? if($i==1):?>
                        <li class="active" data-tab="1"><?= $arItem['PROPERTIES'] ['TITLE'] ['VALUE'] ?></li>
                    <? else: ?>
                    <li data-tab="<?=$i?>"><?= $arItem['PROPERTIES'] ['TITLE'] ['VALUE'] ?></li>
                    <? endif;?>
                <? ++$i;endforeach;?>
            </ul>
        </div>
        <? $i=1; foreach($arResult["ITEMS"] as $arItem):?>
            <? if($i==1):?>
                <div class="box__tab-info" data-tab-content="1">
                    <div class="row">
                        <div class="col-12 order-2 col-md-6 order-md-1 col-xl-7">
                            <div class="box__info">
                                <?= htmlspecialcharsback($arItem['PROPERTIES'] ['TEXT'] ['VALUE'] ['TEXT']) ?>
                             </div>
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => SITE_TEMPLATE_PATH."/include/lang/ru/inc_btn_sign_course.php"
                                )
                            );?>
                        </div>
                        <div class="col-12 order-1 col-md-6 order-md-2 col-xl-5">
                            <div class="box__image"><img src=" <?= existImage($arItem['PROPERTIES'] ['PICTURE'] ['VALUE']) ?>" alt=""></div>
                        </div>
                    </div>
                </div>
            <? else:?>
            <div class="box__tab-info" style="display: none;" data-tab-content="<?=$i?>">
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-6 col-xl-7">
                        <div class="box__info">
                            <?= htmlspecialcharsback($arItem['PROPERTIES'] ['TEXT'] ['VALUE'] ['TEXT']) ?>
                        </div>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH."/include/lang/ru/inc_btn_sign_course.php"
                            )
                        );?>
                    </div>
                    <div class="col-12 d-none d-sm-block col-sm-4 col-md-6 col-xl-5">
                        <div class="box__image"><img src=" <?= existImage($arItem['PROPERTIES'] ['PICTURE'] ['VALUE']) ?>" alt=""></div>
                    </div>
                </div>
            </div>
            <? endif;?>
        <? ++$i; endforeach;?>
        </div>
    </div>
</div>
