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
        'NAME', 'ID','PICTURE','UF_HIGHLIGHT',
    ),
    false
);

while ($el = $res->Fetch()) {
    $tempResult[$el['ID']]['NAME'] = $el['NAME'];
    $tempResult[$el['ID']]['PICTURE'] = CFile::GetPath($el['PICTURE']);
    $tempResult[$el['ID']]['UF_HIGHLIGHT']=$el['UF_HIGHLIGHT'];
}

$arResult['NAME_SECTION'] = $tempResult;
