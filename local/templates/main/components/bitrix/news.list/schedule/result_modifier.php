<?php
$arResult["MONTHS"] = MONTHS;



foreach ($arResult["ITEMS"] as $key => $arItem) {
    $arResult["ITEMS"] [$key] ['COURSE_LEVEL'] = CIBlockElement::GetProperty(
        $arItem['PROPERTIES']['COURSE']['LINK_IBLOCK_ID'],
        $arItem['PROPERTIES']['COURSE']['VALUE'],
        [],
        ['CODE' => 'LEVEL'])->GetNext()['VALUE'];
    $arResult["ITEMS"] [$key] ['PRICE_COURSE'] = CIBlockElement::GetProperty(
        $arItem['PROPERTIES']['COURSE']['LINK_IBLOCK_ID'],
        $arItem['PROPERTIES']['COURSE']['VALUE'],
        [],
        ['CODE' => 'PRICE'])->GetNext()['VALUE'];
}
//($arResult);

$res= repeatSchedule($arResult['ITEMS'],true);
if(isset($res)) {
    foreach ($res as $item) {
        $arResult ['ITEMS'] [] = $item;
    }

    sortSchedule($arResult['ITEMS']);
}