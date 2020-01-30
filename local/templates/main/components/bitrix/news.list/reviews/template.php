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
use  \Bitrix\Main\Localization\Loc;
$this->setFrameMode(true);
define('COUNT_ELEMENT_IN_SET',6); //Кол-во подгружаемых элементов
//?>
<div class="row">
    <div class="col-12 col-xl-6">
        <div class="box__tabs">
            <ul>
                <li class="active" data-review-tab="all"><?=Loc::getMessage('ALL')?></li>
                <? $i = 2;
                foreach ($arResult['NAME_SECTION'] as $keySection=>$section): ?>
                    <li data-review-tab="<?= $keySection ?>"><?= $section ?></li>
                    <? ++$i; endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<div class="wrapper-item active" data-review-info="all">
    <div class="row">
        <div class="col-12">
            <div class="box__item__all">
                <div class="row">

                <? $count_el=0;
                foreach ($arResult["ITEMS"] as $keyItem => $arItem):
                    ++$count_el;
                    if($count_el>COUNT_ELEMENT_IN_SET){
                        continue;
                    }
                    ?>
                    <? if (isset($arItem['PREVIEW_TEXT']) && $arItem['PREVIEW_PICTURE']): ?>
                    <div class="col-12 col-lg-6">
                        <div class="item smoke-color" >
                            <div class="box__head">
                                <div class="box__cover"
                                     style="background-image: url(<?= $arItem['PREVIEW_PICTURE'] ['SRC'] ?>);"></div>
                                <div class="box__description">
                                    <h3 class="name"><?= $arItem ['NAME'] ?></h3>
                                    <span class="profile"><?= $arItem['PROPERTIES'] ['SIGN'] ['VALUE'];?></span>
                                </div>
                            </div>
                            <? if (mb_strlen($arItem['PREVIEW_TEXT']) < $arParams['SIZE_MESSAGE']): ?>

                                <div class="box__text">
                                   <?= htmlspecialcharsback($arItem['PREVIEW_TEXT']);?>
                                </div>
                                <div class="box__text-big hidden">
                                    <?= htmlspecialcharsback($arItem['PREVIEW_TEXT']);?>
                                </div>
                                <div class="btn__more" data-reviewpopup-open><?=Loc::getMessage('SEE_MORE')?></div>
                            <? else:
                                $small= substr($arItem['PREVIEW_TEXT'],0,$arParams['SIZE_MESSAGE']).'...';
                               ?>
                                <div class="box__text">
                                    <?= htmlspecialcharsback( $small);?>
                                </div>
                                <div class="box__text-big hidden">
                                    <?= htmlspecialcharsback($arItem['PREVIEW_TEXT']);?>
                                </div>
                                <div class="btn__more" data-reviewpopup-open><?=Loc::getMessage('SEE_MORE')?></div>
                            <? endif; ?>
                        </div>
                    </div>

                    <? else: ?>
                        <div class="col-12 col-lg-6">
                        <div class="item box__video" data-boxvideo
                             data-video="<?= $arItem['PROPERTIES'] ['HREF'] ['VALUE'];?>">
                            <span style="background-image: url(<?= $arItem['DETAIL_PICTURE'] ['SRC'] ?>);"><i></i></span>
                        </div>
                        </div>
                    <? endif; ?>

                <?

                endforeach; ?>

                </div>
            </div>
        </div>
    </div>
    <? if($count_el>COUNT_ELEMENT_IN_SET):?>
    <div class="row">
        <div class="col-12">
            <form method="post" action="<?= $this->GetFolder() ?>/ajax.php" name="reviews_more">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/lang/ru/inc_btn_more reviews.php"
                    )
                ); ?>
                <input type="hidden" name="iblock_id" value="<?=$arResult['ID']?>">
                <input type="hidden" name="message_size" value="<?=$arParams['SIZE_MESSAGE']?>">
            </form>
        </div>
    </div>
    <?endif;?>
</div>


            <? $i = 2;
            foreach ($arResult['NAME_SECTION'] as $keySection=>$section): ?>
<div class="wrapper-item" data-review-info="<?=$keySection?>">
    <div class="row">
        <div class="col-12">
            <div class="box__item__all">
                <div class="row">
            <? $count_el=0;
            foreach ($arResult["ITEMS"] as $keyItem => $arItem): ?>
                    <? if($arItem['IBLOCK_SECTION_ID']==$keySection):
                    ++$count_el;
                    if($count_el>COUNT_ELEMENT_IN_SET){
                        continue;
                    }
                    ?>
                        <? if (isset($arItem['PREVIEW_TEXT']) && $arItem['PREVIEW_PICTURE']): ?>
                    <div class="col-12 col-lg-6">
                    <div class="item smoke-color" id="">
                                <div class="box__head">
                                    <div class="box__cover"
                                         style="background-image: url(<?= $arItem['PREVIEW_PICTURE'] ['SRC'] ?>);"></div>
                                    <div class="box__description">
                                        <h3 class="name"><?= $arItem ['NAME'] ?></h3>
                                        <span class="profile"><?= $arItem['PROPERTIES'] ['SIGN'] ['VALUE'];?></span>
                                    </div>
                                </div>
                                <? if (mb_strlen($arItem['PREVIEW_TEXT']) < $arParams['SIZE_MESSAGE']): ?>

                                    <div class="box__text">
                                        <?= htmlspecialcharsback($arItem['PREVIEW_TEXT']);?>
                                    </div>
                                    <div class="box__text-big hidden">
                                        <?= htmlspecialcharsback($arItem['PREVIEW_TEXT']);?>
                                    </div>
                                    <div class="btn__more" data-reviewpopup-open><?=Loc::getMessage('SEE_MORE')?></div>
                                <? else:
                                    $small= substr($arItem['PREVIEW_TEXT'],0,$arParams['SIZE_MESSAGE']).'...';
                                    ?>
                                    <div class="box__text">
                                        <?= htmlspecialcharsback( $small);?>
                                    </div>
                                    <div class="box__text-big hidden">
                                        <?= htmlspecialcharsback($arItem['PREVIEW_TEXT']);?>
                                    </div>
                                    <div class="btn__more" data-reviewpopup-open><?=Loc::getMessage('SEE_MORE')?></div>
                                <? endif; ?>
                            </div>
                    </div>
                        <? else: ?>
                        <div class="col-12 col-lg-6">
                            <div class="item box__video" data-boxvideo data-video="<?= $arItem['PROPERTIES'] ['HREF'] ['VALUE'];?>">
                                <span style="background-image: url(<?= $arItem['DETAIL_PICTURE'] ['SRC'] ?>);"><i></i></span>
                            </div>
                        </div>
                        <? endif; ?>
                    <?unset($arResult ['ITEMS'] [$keyItem]);

                    endif;?>

            <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <? if($count_el>COUNT_ELEMENT_IN_SET):?>
    <div class="row">
        <div class="col-12">
            <form method="post" action="<?= $this->GetFolder() ?>/ajax.php" name="reviews_more">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/lang/ru/inc_btn_more reviews.php"
                    )
                ); ?>
                <input type="hidden" name="iblock_id" value="<?=$arResult['ID']?>">
                <input type="hidden" name="message_size" value="<?=$arParams['SIZE_MESSAGE']?>">
            </form>
        </div>
    </div>
    <?endif;?>
</div>
 <? ++$i; endforeach; ?>




