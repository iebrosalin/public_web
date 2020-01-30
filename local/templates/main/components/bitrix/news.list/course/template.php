<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Localization\Loc;
$this->setFrameMode(true);
define('COUNT_ELEMENT_IN_SET',6); //Кол-во подгружаемых элементов
//p_f($arResult);
//?>

<div class="row">
    <div class="col-12">
        <div class="box__tabs">
            <ul>
                <li class="active" data-course-tab="all"><?= Loc::getMessage('ALL')?></li>
                <? $i = 2;
                foreach ($arResult["NAME_SECTION"] as $keySection=>$section): ?>
                    <? if($section['UF_HIGHLIGHT']==1):?>
                    <li data-course-tab="<?= $keySection ?>" ><span class="box__course-free"><?= $section ['NAME'] ?></span></li>
                    <?else:?>
                    <li data-course-tab="<?= $keySection ?>" ><?= $section ['NAME'] ?></li>
                    <?endif;?>
                <? ++$i; endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="box__course-item active" data-course-item="all">
            <ul>
                <? $count_el=0; foreach ($arResult["ITEMS"] as $arItem): ?>
                    <? if($count_el<COUNT_ELEMENT_IN_SET) {
                        if ($count_el == 0):?>
                            <li class="box-big-bottom item-animation">
                                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"
                                   style="background-image: url(<?= existImageFile($arItem['PREVIEW_PICTURE'] ['SRC']) ?>)"
                                   data-item-wraper-animation>
                                    <span class="box__title" data-item-title-animation><?= $arItem['NAME'] ?></span>
                                    <span class="box__description"
                                          data-item-description-animation><?= $arItem ['PROPERTIES'] ['LEVEL'] ['VALUE'] ?></span>
                                    <span class="box__logo-image" data-item-logo-animation
                                          style="background-image: url(<?= existImageFile($arResult["NAME_SECTION"][$arItem ['IBLOCK_SECTION_ID']] ['PICTURE']) ?>)"></span>
                                </a>
                            </li>
                        <? elseif ($count_el % COUNT_ELEMENT_IN_SET === 1):?>
                            <li class="box-big-left item-animation">
                                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"
                                   style="background-image: url(<?= existImageFile($arItem['PREVIEW_PICTURE'] ['SRC']) ?>)"
                                   data-item-wraper-animation>
                                    <span class="box__title" data-item-title-animation><?= $arItem['NAME'] ?></span>
                                    <span class="box__description"
                                          data-item-description-animation><?= $arItem ['PROPERTIES'] ['LEVEL'] ['VALUE'] ?></span>
                                    <span class="box__logo-image" data-item-logo-animation
                                          style="background-image: url(<?= existImageFile($arResult["NAME_SECTION"][$arItem ['IBLOCK_SECTION_ID']] ['PICTURE']) ?>)"></span>
                                </a>
                            </li>
                        <? else:?>
                            <li class="item-animation">
                                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"
                                   style="background-image: url(<?= existImageFile($arItem['PREVIEW_PICTURE'] ['SRC']) ?>)"
                                   data-item-wraper-animation>
                                    <span class="box__title" data-item-title-animation><?= $arItem['NAME'] ?></span>
                                    <span class="box__description"
                                          data-item-description-animation><?= $arItem ['PROPERTIES'] ['LEVEL'] ['VALUE'] ?></span>
                                    <span class="box__logo-image" data-item-logo-animation
                                          style="background-image: url(<?= existImageFile($arResult["NAME_SECTION"][$arItem ['IBLOCK_SECTION_ID']] ['PICTURE']) ?>)"></span>
                                </a>
                            </li>
                        <? endif;
                        ++ $count_el;
                    }
                    else {
                        ++ $count_el;
                        continue;
                    }?>
                <?
                endforeach;  ?>
            </ul>
            <?if($count_el>COUNT_ELEMENT_IN_SET):?>
            <div class="row">
                <div class="col-12 text-center">
                    <form method="post" action="<?= $this->GetFolder() ?>/ajax.php" name="list_course">
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
                    </form>
                </div>
            </div>
            <? endif;?>
        </div>
        <? $i = 2;
        foreach ($arResult["NAME_SECTION"] as $key => $section): ?>
            <div class="box__course-item" data-course-item="<?= $key ?>">
                <ul>
                    <? $count_el=0; foreach ($arResult["ITEMS"] as $keyItem => $arItem): ?>
                        <? if($key == $arItem['IBLOCK_SECTION_ID']): ?>
                            <?
                            if($count_el<COUNT_ELEMENT_IN_SET) {
                                if( $count_el==0):?>
                                    <li class="box-big-bottom item-animation" >
                                        <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"
                                           style="background-image: url(<?= existImageFile($arItem['PREVIEW_PICTURE'] ['SRC']) ?>)"
                                           data-item-wraper-animation>
                                            <span class="box__title" data-item-title-animation><?= $arItem['NAME'] ?></span>
                                            <span class="box__description"
                                                  data-item-description-animation><?= $arItem ['PROPERTIES'] ['LEVEL'] ['VALUE'] ?></span>
                                            <span class="box__logo-image" data-item-logo-animation
                                                  style="background-image: url(<?= existImageFile($arResult["NAME_SECTION"][$arItem ['IBLOCK_SECTION_ID']] ['PICTURE']) ?>)"></span>
                                        </a>
                                    </li>
                                <?elseif($count_el%COUNT_ELEMENT_IN_SET===1):?>
                                    <li class="box-big-left item-animation" >
                                        <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"
                                           style="background-image: url(<?= existImageFile($arItem['PREVIEW_PICTURE'] ['SRC']) ?>)"
                                           data-item-wraper-animation>
                                            <span class="box__title" data-item-title-animation><?= $arItem['NAME'] ?></span>
                                            <span class="box__description"
                                                  data-item-description-animation><?= $arItem ['PROPERTIES'] ['LEVEL'] ['VALUE'] ?></span>
                                            <span class="box__logo-image" data-item-logo-animation
                                                  style="background-image: url(<?= existImageFile($arResult["NAME_SECTION"][$arItem ['IBLOCK_SECTION_ID']] ['PICTURE']) ?>)"></span>
                                        </a>
                                    </li>
                                <?else:?>
                                    <li class="item-animation" >
                                        <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"
                                           style="background-image: url(<?= existImageFile($arItem['PREVIEW_PICTURE'] ['SRC']) ?>)"
                                           data-item-wraper-animation>
                                            <span class="box__title" data-item-title-animation><?= $arItem['NAME'] ?></span>
                                            <span class="box__description"
                                                  data-item-description-animation><?= $arItem ['PROPERTIES'] ['LEVEL'] ['VALUE'] ?></span>
                                            <span class="box__logo-image" data-item-logo-animation
                                                  style="background-image: url(<?= existImageFile($arResult["NAME_SECTION"][$arItem ['IBLOCK_SECTION_ID']] ['PICTURE']) ?>)"></span>
                                        </a>
                                    </li>
                                <? endif;?>
                            <?
                            unset($arResult["ITEMS"] [$keyItem]);
                            ++ $count_el;
                            }
                            else {
                                ++ $count_el;
                                continue;
                            }?>
                    <? endif;
                    endforeach; ?>
                </ul>
                <? if($count_el>COUNT_ELEMENT_IN_SET):?>
                    <div class="row">
                        <div class="col-12 text-center">
                            <form method="post" action="<?= $this->GetFolder() ?>/ajax.php" name="list_course">
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
                            </form>
                        </div>
                    </div>
                <? endif;?>
            </div>
            <? ++$i; endforeach; ?>

    </div>
</div>



