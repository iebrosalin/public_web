<?php
$arResult["MONTHS"]=MONTHS;
//$arId;
//
foreach($arResult["ITEMS"] as $key=>$arItem){
    $arResult["ITEMS"] [$key] ['COURSE_LEVEL']=CIBlockElement::GetProperty(
        $arItem['PROPERTIES']['COURSE']['LINK_IBLOCK_ID'],
        $arItem['PROPERTIES']['COURSE']['VALUE'],
        [],
        ['CODE'=>'LEVEL'])->GetNext()['VALUE'];

}
