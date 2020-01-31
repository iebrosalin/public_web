<?php
require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/csv_data.php");
use \Bitrix\Main\Loader;
if (!Loader::includeModule('iblock') || !Loader::includeModule('catalog'))
{
    die('Error loading module iblock or catalog');
}

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use Bitrix\Main\SystemException;
use Bitrix\Highloadblock\HighloadBlockTable;
use \Bitrix\Catalog\ProductTable;
use Bitrix\Main\Type\DateTime;
use Bitrix\Catalog\GroupTable;
use Bitrix\Catalog\PriceTable;

CModule::IncludeModule('iblock');
CModule::IncludeModule('highloadblock');

/*Read csv file*/
$csvFile = new CCSVData('R', true);
//$res=scandir($_SERVER["DOCUMENT_ROOT"].'/content/');
$csvFile->LoadFile($_SERVER["DOCUMENT_ROOT"]."/s.csv");
$csvFile->SetDelimiter(';');
//p(CIBlockElement::GetByID(8157)->Fetch());
$arRes = $csvFile->Fetch();



/*Fetch ID brand from Highload block "BrandReferences"*/
//$hlblock = HL\HighloadBlockTable::getById(3)->fetch();
//$hlBrandEntity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
//$hlBrandClass = $hlBrandEntity ->getDataClass();
//$result = $hlBrandClass::getList(
//    array(
//        'filter' => array('ID' =>35),
//        'select' => array("*"),
//        'order' => array(
//            'UF_XML_ID' => 'asc'
//        ),
//    )
//);
//$row = $result->fetch();

/*Bitrix API create IB element*/
$bs = new CIBlockElement();
$param=array(
    CUtil::translit($arRes[2],"ru"),
    $arRes[2],
    CFile::MakeFileArray($arRes[7]),
    $arRes[4],
    CFile::MakeFileArray($arRes[8])
);
//
$arFields = array(
    "ACTIVE" => "Y",
    "CODE" =>$param[0],
    "IBLOCK_ID" => 11,
    "IBLOCK_SECTION_ID" => 546,
    "NAME" => $arRes[2],
    "SORT" => 999,
    "DETAIL_PICTURE" => CFile::MakeFileArray($arRes[7]),
    "PREVIEW_TEXT" => $arRes[4],
    "PREVIEW_TEXT_TYPE" => "text",
    "EXTERNAL_ID" => 45,
    "PREVIEW_PICTURE" => CFile::MakeFileArray($arRes[8]),
//    "BRAND"=>35,

);
//p($param);
if($ID > 0)
{
    $res = $bs->Update($ID, $arFields);
}
else
{
    $ID = $bs->Add($arFields);
    $res = ($ID>0);
}

////CIBlockElement::SetPropertyValuesEx($ID,false, array("BRAND"=>array('UF_XML_ID'=>35)));
//echo $bs->LAST_ERROR;
//
$arSKUProperties = array (
    63 => $ID,
    'SKU_SIZE' => 56,
);
$arSKUElement = array(
    "IBLOCK_ID" =>12,
    "XML_ID" => 45,
    "NAME" => $arRes[2],
    "PROPERTY_VALUES" =>  $arSKUProperties,
    "ACTIVE" => "Y"
);

if ($PRODUCT_SKU_ID = $bs->Add($arSKUElement))
{
    echo $bs->LAST_ERROR;
    $result = \Bitrix\Catalog\ProductTable::add(array(
        "ID" => $PRODUCT_SKU_ID,
        'QUANTITY_TRACE' => \Bitrix\Catalog\ProductTable::STATUS_DEFAULT,
        "TYPE" => \Bitrix\Catalog\ProductTable::TYPE_OFFER,
        "PURCHASING_PRICE" => 99999,
        'AVAILABLE' => Bitrix\Catalog\ProductTable::STATUS_YES,
        'QUANTITY' => 0,
        'QUANTITY_TRACE' => Bitrix\Catalog\ProductTable::STATUS_YES,
        'CAN_BUY_ZERO' => Bitrix\Catalog\ProductTable::STATUS_YES
    ));
}

/*Just product*/
//$result = \Bitrix\Catalog\ProductTable::add(array(
//    "ID" => $ID,
//    'QUANTITY_TRACE' => \Bitrix\Catalog\ProductTable::STATUS_DEFAULT,
//    "TYPE" => \Bitrix\Catalog\ProductTable::TYPE_SKU,
//    "PURCHASING_PRICE" => 99999,
//    'AVAILABLE' => Bitrix\Catalog\ProductTable::STATUS_YES,
//    'QUANTITY' => 0,
//    'QUANTITY_TRACE' => Bitrix\Catalog\ProductTable::STATUS_YES,
//    'CAN_BUY_ZERO' => Bitrix\Catalog\ProductTable::STATUS_YES
//));

if ($result->isSuccess())
{
    echo Bitrix\Catalog\ProductTable::STATUS_YES;
}
else
{
    $strImportErrorMessage .= 'Ошибки при добавлении продукта '.$PRODUCT_ID.'<pre>'.var_export($result->getErrorMessages(), true).'</pre></br>';
//    Assg\Import\Helper::m2l('Ошибки при добавлении продукта '.$PRODUCT_ID.'<pre>'.var_export($result->getErrorMessages(), true).'</pre>');
}
$result = PriceTable::add(array(
        'PRODUCT_ID' => $PRODUCT_SKU_ID,
        'CATALOG_GROUP_ID' => 1,
        'PRICE' => 99999,
        'PRICE_SCALE' => 99999,
        'CURRENCY' => 'RUB')
);
if ($result->isSuccess())
{
    $arPricesProduct[$PRODUCT_SKU_ID] = $result->getId();
//    Assg\Import\Helper::m2l('Добавлена цена '.$result->getId().' торгового предложения '.$PRODUCT_SKU_ID.' = '.$objElement->getBasePrice());
}
else
{
    $strImportErrorMessage .= 'Ошибки при добавлении цены торгового предложения '.$PRODUCT_SKU_ID.'<pre>'.var_export($result->getErrorMessages(), true).'</pre></br>';
//    Assg\Import\Helper::m2l('Ошибки при добавлении цены торгового предложения '.$PRODUCT_SKU_ID.'<pre>'.var_export($result->getErrorMessages(), true).'</pre>');
}
CIBlockElement::SetPropertyValuesEx($ID,11,array("BRAND"=>'stile-n'));
/******

//$IBlockOffersCatalogId = 11; // ID инфоблока предложений (должен быть торговым каталогом)
//$productName = "Товар"; // наименование товара
//$offerName = "Торговое предложение"; // наименование торгового предложения
//$offerPrice = 100.50; // Цена торгового предложения
//
//
//$arCatalog = CCatalog::GetByID($IBlockOffersCatalogId);
//
//$IBlockCatalogId = $arCatalog['PRODUCT_IBLOCK_ID']; // ID инфоблока товаров
//$SKUPropertyId = $arCatalog['SKU_PROPERTY_ID']; // ID свойства в инфоблоке предложений типа "Привязка к товарам (SKU)"
//
//$obElement = new CIBlockElement();
//$arFields = array(
//    "ACTIVE" => "Y",
//    "CODE" =>$param[0],
//    "IBLOCK_ID" => 11,
//    "IBLOCK_SECTION_ID" => 463,
//    "NAME" => $arRes[2],
//    "SORT" => 999,
//    "DETAIL_PICTURE" => CFile::MakeFileArray($arRes[7]),
//    "PREVIEW_TEXT" => $arRes[4],
//    "PREVIEW_TEXT_TYPE" => "text",
//    "EXTERNAL_ID" => 45,
//    "PREVIEW_PICTURE" => CFile::MakeFileArray($arRes[8]),
////    "BRAND"=>35,
//);
//$productId = $obElement->Add($arFields); // добавили товар, получили ID
//
//if ($productId) {
//    $obElement = new CIBlockElement();
//    // свойства торгвоого предложения
//    $arOfferProps = array(
//        $SKUPropertyId => $productId,
//    );
//    $arOfferFields = array(
//        'NAME' => $offerName,
//        'IBLOCK_ID' => $IBlockOffersCatalogId,
//        'ACTIVE' => 'Y',
//        'PROPERTY_VALUES' => $arOfferProps
//    );
//
//    $offerId = $obElement->Add($arOfferFields); // ID торгового предложения
//    try {
//        if ($offerId) {
//            // добавляем как товар и указываем цену
//            $catalogProductAddResult = CCatalogProduct::Add(array(
//                "ID" => $offersId,
//                "VAT_INCLUDED" => "Y", //НДС входит в стоимость
//            ));
//            if ($catalogProductAddResult && !CPrice::SetBasePrice($offerId, $offerPrice, "RUB"))
//                throw new Exception("Ошибка установки цены торгового предложения \"{$offerId}\"");
//            else
//                throw new SystemException("Error");
//               // throw new Exception("Ошибка добавления параметров торгового предложения \"{$offerId}\" в каталог товаров");
//        } else {
//            throw new Exception("Ошибка добавления торгового предложения: " . $obElement->LAST_ERROR);
//        }
//    }
//    catch(SystemException $exception){
//        p( $exception->getCode());
//    }
//    }
//else
//{
//    throw new Exception("Ошибка добавления товара: " . $obElement->LAST_ERROR);
//}
***/
//while ($arRes = $csvFile->Fetch()) {
////    p($arRes);
//
//}
