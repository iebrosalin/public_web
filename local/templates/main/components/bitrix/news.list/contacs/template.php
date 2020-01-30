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
//?>
<div class="row">
    <div class="col-12">
        <h2><?= Loc::getMessage('TITLE_CONTACTS')?></h2>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="box__address">
            <?= htmlspecialcharsback($arResult['ITEMS'] [0] ['PROPERTIES'] ['ADRESS'] ['VALUE'] ['TEXT'])?>
        </div>
        <div class="box__contact-item">
            <div class="box__socki">
                <ul>
                    <?
                    $tempSoc=[
                        'vk'=>$arResult['ITEMS'] [0] ['PROPERTIES'] ['VK'] ['VALUE'],
                        'instagram'=>$arResult['ITEMS'] [0] ['PROPERTIES'] ['INSTAGRAM'] ['VALUE'],
                        'facebook'=>$arResult['ITEMS'] [0] ['PROPERTIES'] ['FACEBOOK'] ['VALUE'],
                        'youtube'=>$arResult['ITEMS'] [0] ['PROPERTIES'] ['YOUTUBE'] ['VALUE'],
                    ];
                    foreach ($tempSoc as $key=>$value):
                    if(strlen($value)>0):
                    ?>
                    <li><a href="<?=$value?>" style="background-image: url(<?=SITE_TEMPLATE_PATH.'/img/icon/'.$key.'.svg'?>);"></a></li>
                    <?
                    endif;
                    endforeach;?>

                </ul>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <?  if(strlen($arResult['ITEMS'] [0] ['PROPERTIES'] ['WORK_LEARN'] ['VALUE'])>0):
        ?>
        <div class="box__contact-item"><span>Электронная почта:</span><a href="mailto:<?=$arResult['ITEMS'] [0] ['PROPERTIES'] ['WORK_LEARN'] ['VALUE']?>"><?=$arResult['ITEMS'] [0] ['PROPERTIES'] ['WORK_LEARN'] ['VALUE']?></a></div>
        <? endif;?>
        <?  if(strlen($arResult['ITEMS'] [0] ['PROPERTIES'] ['SKYPE_CONTACT'] ['VALUE'])>0):
        ?>
        <div class="box__contact-item"><span>Skype:</span><a href="skype:<?=$arResult['ITEMS'] [0] ['PROPERTIES'] ['SKYPE_CONTACT'] ['VALUE']?>?call"><?=$arResult['ITEMS'] [0] ['PROPERTIES'] ['SKYPE_CONTACT'] ['VALUE']?></a></div>
        <? endif;?>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="box__contact-item">
            <span>Онлайн консультант:</span>
            <div class="box__person">
                <div class="box__image" style="background-image: url(<?= CFile::GetPath($arResult['ITEMS'] [0] ['PROPERTIES'] ['PHOTO_CONS'] ['VALUE'])?>)"></div>
                <span><?=$arResult['ITEMS'] [0] ['PROPERTIES'] ['NAME_CONS'] ['VALUE']?></span>
                <div class="box__description"><?=$arResult['ITEMS'] [0] ['PROPERTIES'] ['SIGN_CONS'] ['VALUE']?></div>
                <div class="box__link"><a href="<?=$arResult['ITEMS'] [0] ['PROPERTIES'] ['HREF_CONS'] ['VALUE']?>"><?= Loc::getMessage("SIGN_HREF_CONS")?></a></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <?= htmlspecialcharsback($arResult['ITEMS'] [0] ['PROPERTIES'] ['VK_WIDGET'] ['VALUE'] ['TEXT'])?>
    </div>
</div>


