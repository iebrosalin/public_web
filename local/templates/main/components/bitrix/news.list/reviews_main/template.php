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
<div class="row">
    <div class="col-12 col-xl-6">
        <div class="box__tabs">
            <ul>
                <li class="active" data-review-tab="1"><?= Loc::getMessage('ALL') ?></li>
                <? $i = 2;
                foreach ($arResult['NAME_SECTION'] as $section): ?>
                    <li data-review-tab="<?= $i ?>"><?= $section ?></li>
                    <? ++$i; endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="col-12 d-none d-xl-block col-xl-6">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="box__tab-reviews">
                    <div class="btn btn-smoke" data-message-open><button>Оставить отзыв</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                    <div class="box__tab-reviews">
                        <div class="btn"><a href="/reviews/"><?= Loc::getMessage('ALL_REVIEWS') ?></a></div>
                    </div>
             </div>
        </div>
    </div>




                <div class="wrapper-item active" data-review-info="1">
                    <div class="row">
                        <div class="col-12">
                            <div class="box__carusel-reviews owl-carousel">
                                <div class="wrapper-carusel">
                                    <? foreach ($arResult["ITEMS"] as $keyItem => $arItem): ?>
                                        <? if (isset($arItem['PREVIEW_TEXT']) && $arItem['PREVIEW_PICTURE']): ?>
                                            <div class="item smoke-color">
                                                <div class="box__head">
                                                    <div class="box__cover"
                                                         style="background-image: url(<?= existImageFile($arItem['PREVIEW_PICTURE'] ['SRC']) ?>);"></div>
                                                    <div class="box__description">
                                                        <h3 class="name"><?= $arItem ['NAME'] ?></h3>
                                                        <span class="profile"><?= $arItem['PROPERTIES'] ['SIGN'] ['VALUE']; ?></span>
                                                    </div>
                                                </div>
                                                <? $messLen=mb_strlen($arItem['PREVIEW_TEXT']);
                                                    if ( $messLen< $arParams['SIZE_MESSAGE']): ?>

                                                    <div class="box__text">
                                                        <?= htmlspecialcharsback($arItem['PREVIEW_TEXT']); ?>
                                                    </div>
                                                    <? if($messLen> 150):?>
                                                    <div class="box__text-big hidden">
                                                        <?= htmlspecialcharsback($arItem['PREVIEW_TEXT']); ?>
                                                    </div>
                                                    <div class="btn__more 	 d-lg-none d-md-none"
                                                         data-reviewpopup-open><?= Loc::getMessage('SEE_MORE') ?></div>
                                                 <? endif;?>
                                                <? else:
                                                    $small = substr($arItem['PREVIEW_TEXT'], 0, $arParams['SIZE_MESSAGE']) . '...';
                                                    ?>
                                                    <div class="box__text">
                                                        <?= htmlspecialcharsback($small); ?>
                                                    </div>
                                                    <div class="box__text-big hidden">
                                                        <?= htmlspecialcharsback($arItem['PREVIEW_TEXT']); ?>
                                                    </div>
                                                    <div class="btn__more"
                                                         data-reviewpopup-open><?= Loc::getMessage('SEE_MORE') ?></div>
                                                <? endif; ?>
                                            </div>


                                        <? else: ?>
                                            <div class="item box__video" data-boxvideo
                                                 data-video="<?= $arItem['PROPERTIES'] ['HREF'] ['VALUE']; ?>">
                                                <span style="background-image: url(<?= existImageFile($arItem['DETAIL_PICTURE'] ['SRC']) ?>);"><i></i></span>
                                            </div>
                                        <? endif; ?>
                                    <? endforeach; ?>
                                </div>
                            </div>
                            <div class="wrapper-scroll">
                                <div class="handle"></div>
                            </div>
                            <div class="wrapper-nav-slider">
                                <div class="box__nav-left"></div>
                                <div class="box__nav-right"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <? $i = 2;
                foreach ($arResult['NAME_SECTION'] as $keySection => $section): ?>
                <div class="wrapper-item" data-review-info="<?= $i ?>">
                    <div class="row">
                        <div class="col-12">
                            <div class="box__carusel-reviews owl-carousel">
                                <div class="wrapper-carusel">
                                    <? foreach ($arResult["ITEMS"] as $keyItem => $arItem): ?>
                                    <? if ($arItem['IBLOCK_SECTION_ID'] == $keySection): ?>
                                    <? if (isset($arItem['PREVIEW_TEXT']) && $arItem['PREVIEW_PICTURE']): ?>
                                    <div class="item smoke-color"
                                    ">
                                    <div class="box__head">
                                        <div class="box__cover"
                                             style="background-image: url(<?= existImageFile($arItem['PREVIEW_PICTURE'] ['SRC']) ?>);"></div>
                                        <div class="box__description">
                                            <h3 class="name"><?= $arItem ['NAME'] ?></h3>
                                            <span class="profile"><?= $arItem['PROPERTIES'] ['SIGN'] ['VALUE']; ?></span>
                                        </div>
                                    </div>
                                    <? if (mb_strlen($arItem['PREVIEW_TEXT']) < $arParams['SIZE_MESSAGE']): ?>

                                        <div class="box__text">
                                            <?= htmlspecialcharsback($arItem['PREVIEW_TEXT']); ?>
                                        </div>
                                    <? else:
                                        $small = substr($arItem['PREVIEW_TEXT'], 0, $arParams['SIZE_MESSAGE']) . '...';
                                        ?>
                                        <div class="box__text">
                                            <?= htmlspecialcharsback($small); ?>
                                        </div>
                                        <div class="box__text-big hidden">
                                            <?= htmlspecialcharsback($arItem['PREVIEW_TEXT']); ?>
                                        </div>
                                        <div class="btn__more"
                                             data-reviewpopup-open><?= Loc::getMessage('SEE_MORE') ?></div>
                                    <? endif; ?>
                                </div>
                                <? else: ?>
                                    <div class="item box__video" data-boxvideo
                                         data-video="<?= $arItem['PROPERTIES'] ['HREF'] ['VALUE']; ?>">
                                        <span style="background-image: url(<?= existImageFile($arItem['DETAIL_PICTURE'] ['SRC']) ?>);"><i></i></span>
                                    </div>
                                <? endif; ?>

                                <?
                                unset($arResult ['ITEMS'] [$keyItem]);
                                endif; ?>
                                <? endforeach; ?>
                            </div>

                        </div>
                        <div class="wrapper-scroll">
                            <div class="handle"></div>
                        </div>
                        <div class="wrapper-nav-slider">
                            <div class="box__nav-left"></div>
                            <div class="box__nav-right"></div>
                        </div>
                    </div>
                </div>
            </div>
            <? ++$i;
            endforeach; ?>


            <div class="col-12 d-block d-xl-none">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="box__tab-reviews">
                            <div class="btn btn-smoke" data-message-open>
                                <button type="button">Оставить отзыв
                                    <button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="box__tab-reviews">
                            <div class="btn">
                                <a href="/reviews/"><?= Loc::getMessage('ALL_REVIEWS') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


