<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
//p_f($arResult);
//?>

<div class="box__select" multiple="multiple">
									<select name="course">
                                        <? foreach ($arResult ['ITEMS'] as $arItem):?>
										<option value="<?= $arItem['ID']?>"><?= $arItem['NAME'].' - '.$arItem['DISPLAY_PROPERTIES'] ['PRICE'] ['VALUE'] ?></option>
                                        <? endforeach;?>
									</select>
								</div>
