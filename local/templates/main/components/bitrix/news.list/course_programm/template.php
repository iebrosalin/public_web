<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use  Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);
//p_f($arResult);
//?>
<div class="row">
    <div class="col-12">
<h2><?= Loc::getMessage('PROGRAM_COURSE')?></h2>
<div class="box__description">
<?= htmlspecialcharsback($arResult ['SECTION'] ['PATH'] ['0'] ['DESCRIPTION'])?>
</div>
</div>
</div>
<div class="row">
    <div class="col-12">
        <div class="box__accordion">
            <? $i=1; foreach ($arResult ['ITEMS'] as $arItem):
                $order=($i<10)?("0".$i):$i;?>
            <div class="box__item">
                <h3><i><?= $order?></i><?= $arItem['NAME'] ?></h3>
                <div class="box__info" style="display: none;">
                   <?= $arItem ['PREVIEW_TEXT']?>
                </div>
            </div>
            <? ++$i; endforeach;?>
        </div>
    </div>
</div>