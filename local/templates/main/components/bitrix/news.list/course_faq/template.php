<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use  Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

//?>

<section class="box__quest-course">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Часто задаваемые вопросы</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="box__accordion">
                        <? $number = 1;?>
                        <? foreach ($arResult['ITEMS'] as $arItem):?>
                            <div class="box__item">                          
                            <? $order = ($number < 10) ? ("0" . $number) : $number; ?>
                                <h3><i><?= $order ?></i><?= $arItem['NAME'] ?></h3>
                                <div class="box__info">
                                    <?= htmlspecialcharsback($arItem['PREVIEW_TEXT']) ?>
                                </div>
                            </div>
                        <? ++$number;?>
                        <? endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="btn-smoke text-center"><a href="/faq/">Все вопросы</a></div>
                    </div>
                </div> 
            </div>
</section>