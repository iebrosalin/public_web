<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
use \Bitrix\Main\Localization\Loc;
?>
<div class="box__presentation-link"><a href="<?= $arResult['FILE']?>"><?= Loc::getMessage('PRESENTATION')?></a></div>
<div class="box__socki">
    <ul>
        <?
        $tempSoc=[
            'vk'=>$arResult['ITEMS'] [0] ['PROPERTIES'] ['VK'] ['VALUE'],
            'instagram'=>$arResult['ITEMS'] [0] ['PROPERTIES'] ['INSTAGRAM'] ['VALUE'],
            'facebook'=>$arResult['ITEMS'] [0] ['PROPERTIES'] ['FACEBOOK'] ['VALUE'],
            'youtube'=>$arResult['ITEMS'] [0] ['PROPERTIES'] ['YOUTUBE'] ['VALUE'],
        ];
        foreach ($arResult['SOCIAL'] as $key=>$value):
            if(strlen($value)>0):
                ?>
                <li><a href="<?=$value?>" style="background-image: url(<?=SITE_TEMPLATE_PATH.'/img/icon/'.$key.'.svg'?>);"></a></li>
            <?
            endif;
        endforeach;?>
    </ul>
</div>