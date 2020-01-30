<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use  Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

//?>
<div class="box__navigation" data-nav>
    <span class="box__bg-right"></span>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="box__header">
                    <? if($APPLICATION->GetCurPage()=='/'):?>

                        <img src="<?= SITE_TEMPLATE_PATH?>/img/icon/Person_Person_Logo.svg" alt="">
                    <? else: ?>
                        <a href="/">
                            <img src="<?= SITE_TEMPLATE_PATH?>/img/icon/Person_Person_Logo.svg" alt="">
                        </a>
                    <? endif; ?>
                    <div class="btn__close" style="background-image: url(<?= SITE_TEMPLATE_PATH?>/img/icon/x_menu.svg)" data-popup-close></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-5">
                <div class="wrapper-nav">
                    <div class="box__nav">
                        <ul>
                                                    <? foreach ($arResult['ITEMS'] as  $arItem):?>
                                                        <li><a href="<?=$arItem ['PROPERTIES'] ['HREF'] ['VALUE']?>"><?=$arItem ['NAME']?></a></li>
                                                        <?endforeach;?>
                        </ul>
                    </div>
                    <div class="box__bottom">
                        <div class="row">
                            <div class="col-12 col-xl-6">
                                <?$APPLICATION->IncludeComponent(
                                    "Person:Person_reference",
                                    "menu",
                                    Array(
                                        "CACHE_TIME" => "86400",
                                        "CACHE_TYPE" => "A",
                                        "IBLOCK_ID" => "1",
                                        "IBLOCK_TYPE" => "about_Person"
                                    )
                                );?>
                            </div>
                            <div class="col-12 col-xl-6">
                                <?$APPLICATION->IncludeComponent(
                                    "Person:href_policy",
                                    "menu",
                                    Array(
                                        "CACHE_TIME" => "86400",
                                        "CACHE_TYPE" => "A",
                                        "IBLOCK_ID" => "1",
                                        "IBLOCK_TYPE" => "about_Person"
                                    )
                                );?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>