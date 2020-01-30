<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use  Bitrix\Main\Localization\Loc;

//$this->setFrameMode(true);
//p_f($arResult);
//?>

<div class="row">
    <div class="col-12">
        <div class="box__tabs" data-tabs="question">
            <ul>
                <li data-tab="question-1" class="active"><?= Loc::getMessage('ALL') ?></li>
                <? $i = 2;
                foreach ($arResult["NAME_SECTION"] as $section): ?>
                    <li data-tab="<?= 'question-' . $i ?>"><?= $section ['NAME'] ?></li>
                    <? ++$i; endforeach; ?>

            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="box__item__all" data-accordion="question">
            <div class="box__accordion active" data-accordion="question-1">
                <? $number = 1;
                foreach ($arResult ['ITEMS'] as $arItem): ?>
                    <? $order = ($number < 10) ? ("0" . $number) : $number; ?>
                    <div class="box__item">
                        <h3><i><?= $order ?></i><?= $arItem['NAME'] ?></h3>
                        <div class="box__info">
                            <?= $arItem['PREVIEW_TEXT'] ?>
                        </div>
                    </div>
                    <? ++$number; endforeach; ?>
            </div>
            <? $iSect = 2;
            $number = 1;
            foreach ($arResult['NAME_SECTION'] as $keySection => $section): //p($iSect);?>

                <div class="box__accordion" data-accordion="<?= "question-" . $iSect ?>">
                    <? $number = 1; foreach ($arResult['ITEMS'] as $arItem):?>
                        <? if ($keySection == $arItem['IBLOCK_SECTION_ID']):
                            ?>
                            <? $order = ($number < 10) ? ("0" . $number) : $number; ?>
                            <div class="box__item">
                                <h3><i><?= $order ?></i><?= $arItem['NAME'] ?></h3>
                                <div class="box__info">
                                    <?= $arItem['PREVIEW_TEXT'] ?>
                                </div>
                            </div>
                            <? ++$number; endif; ?>
                    <? endforeach ?>
                </div>
                <? ++$iSect; endforeach; ?>
        </div>
    </div>
</div>

