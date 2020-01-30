<?php
$tempResult;
$res = CIBlockSection::GetList(
    $arOrder = array("SORT" => "ASC"),
    Array(
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'ACTIVE'=>'Y',
    ),
    false,
    Array(
        'NAME', 'ID'
    ),
    false
);

while ($el = $res->Fetch()) {
    $tempResult[$el['ID']] = $el['NAME'];
}

$arResult['NAME_SECTION'] = $tempResult;
//p_f($arResult);