<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
use \Bitrix\Main\Localization\Loc;
?>
<div class="box__phone">
    <span class="d-none d-xl-block"><a data-contact-header>Связаться с нами</a></span>
    <ul>
        <? //foreach($arResult ['SOCIAL'] as $item):?>
        <?if(isset( $arResult['PHONE'])):?>
            <li><a href="tel:<?=  $arResult['PHONE']?>"><?= $arResult['PHONE']?></a></li>
        <? endif;?>
            <?if(isset( $arResult['SOCIAL'] ['WHATSAPP'] ['VALUE'])):?>
                <li><a href="<?=  $arResult['SOCIAL'] ['WHATSAPP']['VALUE']?>" target="_blank"><?= Loc::getMessage('WHATSAPP')?></a></li>
            <? endif;?>
            <?if(isset($arResult['SOCIAL'] ['TELEGRAM'] ['VALUE'])):?>
                <li><a href="<?= $arResult['SOCIAL'] ['TELEGRAM'] ['VALUE']?>" target="_blank"><?= Loc::getMessage('TELEGRAM')?></a></li>
            <? endif;?>
            <?if(isset($arResult['SOCIAL'] ['VIBER'] ['VALUE'])):?>
                <li><a href="<?= $arResult['SOCIAL'] ['VIBER'] ['VALUE']?>" target="_blank"><?= Loc::getMessage('VIBER')?></a></li>
            <? endif;?>
            <?if(isset($arResult['SOCIAL'] ['SKYPE'] ['VALUE'])):?>
                <li><a href="<?= $arResult['SOCIAL'] ['SKYPE']['VALUE']?>" target="_blank"><?= Loc::getMessage('SKYPE')?></a></li>
            <? endif;?>
        <?if(isset($arResult['SOCIAL'] ['VK_SEND_MESSAGE'] ['VALUE'])):?>
            <li><a href="<?= $arResult['SOCIAL'] ['FACEBOOK_MASSENGER']['VALUE']?>" target="_blank"><?= "Facebook"?></a></li>
        <? endif;?>
        <?if(isset($arResult['SOCIAL'] ['VK_SEND_MESSAGE'] ['VALUE'])):?>
            <li><a href="<?= $arResult['SOCIAL'] ['VK_SEND_MESSAGE']['VALUE']?>" target="_blank"><?= 'Vk'?></a></li>
        <? endif;?>
        <?//endforeach;?>
        <li data-callback-open><a href="">Заказать звонок</a></li>
    </ul>
</div>
<div class="box__nav-right">
    <ul>
        <li data-feedback data-contact-header>Заказать звонок</li>
	</ul>
</div>