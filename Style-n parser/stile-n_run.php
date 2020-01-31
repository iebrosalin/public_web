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
use Assg\Import\Helper;

$PATH_TO_FOLDER="/upload/stile-n";
$PRICE=0;
//$NOMINAL=1;
$NAME=2;
$URL_STILE_N=3;
$DESCRIPTION=4;
$SIZE=5;
$PIC_PREVIEW=7;
$PIC_DETAIL=8;
$BRAND='stile-n';
$IdCatalog=11;
$CATALOG_GROUP_ID=1;
$IdOfferCatalog=12;
$SKU_CODE=63;
$count_step=0;

/*Read csv file*/
$csvFile = new CCSVData('R', true);

$arRawFiles=scandir($_SERVER["DOCUMENT_ROOT"].$PATH_TO_FOLDER);
$arFiles;

foreach ($arRawFiles as $file){
    preg_match('/[a-z]+.*[.]csv/i',$file,$res);
    if(is_set($res[0])) $arFiles[]=$res;
    else continue;
}


foreach ($arFiles as $file) {
    $csvFile = new CCSVData('R', true);
    $csvFile->LoadFile($_SERVER["DOCUMENT_ROOT"] . $PATH_TO_FOLDER . "/" . $file[0]);
    $csvFile->SetDelimiter(';');

    preg_match_all('/([a-z]+.*)[.]/i',$file[0],$res);
    $bSection = new CIBlockSection;
    $code=CUtil::translit($res[1][0],"ru");
    $name=CUtil::translit($res[1][0],"ru");
    $arFields = Array(
        "ACTIVE" => 'Y',
        "IBLOCK_ID" => $IdCatalog,
        "NAME" => $name,
        "SORT" => 999,
        "CODE" => $code,
    );

    if($IdSection > 0)
    {
        $res = $bSection->Update($ID, $arFields);
    }
    else
    {
        $IdSection = $bSection->Add($arFields);
        $res = ($IdSection>0);
    }

    if(!$res)
        echo $bSection->LAST_ERROR;

    while ($row = $csvFile->Fetch()) {
        $bs = new CIBlockElement();

        $arFields = array(
            "ACTIVE" => "Y",
            "CODE" =>CUtil::translit($row[$NAME],"ru"),
            "IBLOCK_ID" => $IdCatalog,
            "IBLOCK_SECTION_ID" => $IdSection,
            "NAME" => $row[$NAME],
            "SORT" => 999,
            "DETAIL_PICTURE" => CFile::MakeFileArray($row[$PIC_DETAIL]),
            "PREVIEW_TEXT" => $row[$DESCRIPTION],
            "PREVIEW_TEXT_TYPE" => "text",
            "XML_ID" => CUtil::translit($row[$NAME],"ru"),
            "PREVIEW_PICTURE" => CFile::MakeFileArray($row[$PIC_PREVIEW]),

        );
        if($ID > 0)
        {
            $res = $bs->Update($ID, $arFields);
        }
        else
        {
            $ID = $bs->Add($arFields);
            $res = ($ID>0);
        }
        echo $bs->LAST_ERROR;

        $arSize=explode(', ',$row[$SIZE]);
        foreach ($arSize as $sku_size){
            $arSKUProperties = array (
                    $SKU_CODE => $ID,
                    'SKU_SIZE' => $sku_size,
                );
                $arSKUElement = array(
                    "IBLOCK_ID" => $IdOfferCatalog,
                    "XML_ID" => CUtil::translit($row[$NAME].' '.$sku_size,"ru"),
                    "NAME" => $row[$NAME],
                    "PROPERTY_VALUES" =>  $arSKUProperties,
                    "ACTIVE" => "Y"
                );

           // echo $bs->LAST_ERROR;
                if ( $PRODUCT_SKU_ID = $bs->Add($arSKUElement))
                {

                    $result = \Bitrix\Catalog\ProductTable::add(array(
                        "ID" => $PRODUCT_SKU_ID,
                        'QUANTITY_TRACE' => \Bitrix\Catalog\ProductTable::STATUS_DEFAULT,
                        "TYPE" => \Bitrix\Catalog\ProductTable::TYPE_OFFER,
                        "PURCHASING_PRICE" => $row[$PRICE],
                        'AVAILABLE' => Bitrix\Catalog\ProductTable::STATUS_YES,
                        'QUANTITY' => 0,
                        'QUANTITY_TRACE' => Bitrix\Catalog\ProductTable::STATUS_YES,
                        'CAN_BUY_ZERO' => Bitrix\Catalog\ProductTable::STATUS_YES
                    ));
                }

                if ($result->isSuccess())
                {
                    echo Bitrix\Catalog\ProductTable::STATUS_YES;
                }
                else
                {
                    $strImportErrorMessage .= 'Ошибки при добавлении продукта '.$PRODUCT_ID.'<pre>'.var_export($result->getErrorMessages(), true).'</pre></br>';
                    Assg\Import\Helper::m2l('Ошибки при добавлении продукта '.$PRODUCT_ID.'<pre>'.var_export($result->getErrorMessages(), true).'</pre>');
                }
        }

        $result = PriceTable::add(array(
        'PRODUCT_ID' => $PRODUCT_SKU_ID,
        'CATALOG_GROUP_ID' => $CATALOG_GROUP_ID,
        'PRICE' => $row[$PRICE],
        'PRICE_SCALE' => $row[$PRICE],
        'CURRENCY' => 'RUB',
                )
        );
        if ($result->isSuccess())
        {
            $arPricesProduct[$PRODUCT_SKU_ID] = $result->getId();
           // Assg\Import\Helper::m2l('Добавлена цена '.$result->getId().' торгового предложения '.$PRODUCT_SKU_ID.' = '.$objElement->getBasePrice());
        }
        else
        {
            $strImportErrorMessage .= 'Ошибки при добавлении цены торгового предложения '.$PRODUCT_SKU_ID.'<pre>'.var_export($result->getErrorMessages(), true).'</pre></br>';
          //  Assg\Import\Helper::m2l('Ошибки при добавлении цены торгового предложения '.$PRODUCT_SKU_ID.'<pre>'.var_export($result->getErrorMessages(), true).'</pre>');
        }
        CIBlockElement::SetPropertyValuesEx($ID,$IdCatalog,array("BRAND"=>$BRAND));
        ++$count_step;
        if ($count_step == 20)
        {
            $count_step=0;
            sleep(1);
        }

    }

}

////p(CIBlockElement::GetByID(8157)->Fetch());


//
///*Bitrix API create IB element*/
//$bs = new CIBlockElement();
//$param=array(
//    CUtil::translit($arRes[2],"ru"),
//    $arRes[2],
//    CFile::MakeFileArray($arRes[7]),
//    $arRes[4],
//    CFile::MakeFileArray($arRes[8])
//);
//
////$arFields = array(
////    "ACTIVE" => "Y",
////    "CODE" =>$param[0],
////    "IBLOCK_ID" => 11,
////    "IBLOCK_SECTION_ID" => 546,
////    "NAME" => $arRes[2],
////    "SORT" => 999,
////    "DETAIL_PICTURE" => CFile::MakeFileArray($arRes[7]),
////    "PREVIEW_TEXT" => $arRes[4],
////    "PREVIEW_TEXT_TYPE" => "text",
////    "EXTERNAL_ID" => 45,
////    "PREVIEW_PICTURE" => CFile::MakeFileArray($arRes[8]),
//////    "BRAND"=>35,
////
////);
////p($param);
////if($ID > 0)
////{
////    $res = $bs->Update($ID, $arFields);
////}
////else
////{
////    $ID = $bs->Add($arFields);
////    $res = ($ID>0);
////}
//
//////CIBlockElement::SetPropertyValuesEx($ID,false, array("BRAND"=>array('UF_XML_ID'=>35)));
////echo $bs->LAST_ERROR;
////
//$ID=17068;
//$arSKUProperties = array (
//    63 => $ID,
//    'SKU_SIZE' => '56-58',
//);
//$arSKUElement = array(
//    "IBLOCK_ID" =>12,
//    "XML_ID" => 45,
//    "NAME" => $arRes[2],
//    "PROPERTY_VALUES" =>  $arSKUProperties,
//    "ACTIVE" => "Y"
//);
//
//if ($PRODUCT_SKU_ID = $bs->Add($arSKUElement))
//{
//    echo $bs->LAST_ERROR;
//    $result = \Bitrix\Catalog\ProductTable::add(array(
//        "ID" => $PRODUCT_SKU_ID,
//        'QUANTITY_TRACE' => \Bitrix\Catalog\ProductTable::STATUS_DEFAULT,
//        "TYPE" => \Bitrix\Catalog\ProductTable::TYPE_OFFER,
//        "PURCHASING_PRICE" => 99999,
//        'AVAILABLE' => Bitrix\Catalog\ProductTable::STATUS_YES,
//        'QUANTITY' => 0,
//        'QUANTITY_TRACE' => Bitrix\Catalog\ProductTable::STATUS_YES,
//        'CAN_BUY_ZERO' => Bitrix\Catalog\ProductTable::STATUS_YES
//    ));
//}
//
//if ($result->isSuccess())
//{
//    echo Bitrix\Catalog\ProductTable::STATUS_YES;
//}
//else
//{
//    $strImportErrorMessage .= 'Ошибки при добавлении продукта '.$PRODUCT_ID.'<pre>'.var_export($result->getErrorMessages(), true).'</pre></br>';
//    Assg\Import\Helper::m2l('Ошибки при добавлении продукта '.$PRODUCT_ID.'<pre>'.var_export($result->getErrorMessages(), true).'</pre>');
//}
//$result = PriceTable::add(array(
//        'PRODUCT_ID' => $PRODUCT_SKU_ID,
//        'CATALOG_GROUP_ID' => 1,
//        'PRICE' => 99999,
//        'PRICE_SCALE' => 99999,
//        'CURRENCY' => 'RUB')
//);
//if ($result->isSuccess())
//{
//    $arPricesProduct[$PRODUCT_SKU_ID] = $result->getId();
//    Assg\Import\Helper::m2l('Добавлена цена '.$result->getId().' торгового предложения '.$PRODUCT_SKU_ID.' = '.$objElement->getBasePrice());
//}
//else
//{
//    $strImportErrorMessage .= 'Ошибки при добавлении цены торгового предложения '.$PRODUCT_SKU_ID.'<pre>'.var_export($result->getErrorMessages(), true).'</pre></br>';
//    Assg\Import\Helper::m2l('Ошибки при добавлении цены торгового предложения '.$PRODUCT_SKU_ID.'<pre>'.var_export($result->getErrorMessages(), true).'</pre>');
//}
//CIBlockElement::SetPropertyValuesEx($ID,11,array("BRAND"=>$BRAND));
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
//die();
