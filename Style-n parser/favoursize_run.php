<?
// <title>Favoursize</title>
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Highloadblock\HighloadBlockTable;
use \Bitrix\Catalog\ProductTable;
use Bitrix\Main\Type\DateTime;
use Bitrix\Catalog\GroupTable;
use Bitrix\Catalog\PriceTable;
use Bitrix\Iblock\ElementTable;

while (@ob_end_flush());

if (!Loader::includeModule('iblock') || !Loader::includeModule('catalog'))
{
    die('Error loading module iblock or catalog');
}

/**
 *
 * @var string $bCGI
 */
$bCLI = false;
/**
 *
 * @var string $DEBUG
 */
$DEBUG = true;
$start = microtime(true);
if (defined('BX_CAT_CRON') && BX_CAT_CRON)
{
    while (@ob_end_flush());
    /**
     *
     * @var string $EOL '<BR>' | '\n'
     */
    $EOL = PHP_EOL;
    $bCLI = true;

    $micro = sprintf("%06d",($start - floor($start)) * 1000000);
    $d = new \DateTime( date('Y-m-d H:i:s.'.$micro, $start) );

    print_r("Import start: ".$d->format("Y-m-d H:i:s").$EOL);

    /**
     * Fix bitrix shit
     * Varibal in scope
     * @var int PROFILE_ID
     */
    $PROFILE_ID = $profile_id;
}
else
{
    $EOL = "</br>";
}



/**
 *
 * @var string $strImportOKMessage
 */
$strImportOKMessage = "";
/**
 *
 * @var string $strImportErrorMessage
 */
$strImportErrorMessage = "";

/**
 * This block include file
 */
$strPatch = "classes/assg/import/";
$arIncludeFile = array (
    "helper.php",
    "abstractElement.php",
);
$arRequiredClass = array (
    "SimpleXMLElement",
    "Assg\Import\Helper",
    "Assg\Import\Element"
);
$arVars = array (
    "LOCAL_FILE",
    "LINK_FILE",
    "IBLOCK_ID",
    "SITE_NAME_ABBR",
    "CONVERT_UTF8",
    "SETUP_PROFILE_NAME",
    "URL_DATA_FILE",
    "MARKUP"
);
/**
 * @var int IBLOCK_ID
 */
$IBLOCK_ID;
/* foreach ($arVars as $strNameVar) {
	$strImportOKMessage .= ${$strNameVar}."</br>";
} */

switch ($SITE_NAME_ABBR) {
    case "PR":
        $arIncludeFile[] = 	"primilineaElement.php";
        $arRequiredClass[] = 	"Assg\Import\primalineaElement";

        break;
    case "AV":
        $arIncludeFile[] = 	"avigalElement.php";
        $arRequiredClass[] = 	"Assg\Import\avigalElement";

        break;
    case "LX":
        $arIncludeFile[] = 	"luxuryElement.php";
        $arRequiredClass[] = 	"Assg\Import\luxuryElement";

        break;
    default:
        ;
        break;
}

foreach ($arIncludeFile as $strFileName)
{
    if (file_exists(Loader::getLocal($strPatch).$strFileName))
        include(Loader::getLocal($strPatch).$strFileName);
}
foreach ($arRequiredClass as $strClassName)
{
    if (!class_exists($strClassName))
    {

        $strImportErrorMessage .= "Нет библиотеки {$strClassName}, дальнейшая работа импорта не возможна".$EOL;
        if ($bCLI)
            print_r ($strImportErrorMessage);
        return;
    }
}

Assg\Import\Helper::setFlagCLI();
Assg\Import\Helper::$strStart = $start;

/**
 * Test blocks
 */
/*
$IBlockOffersCatalogId = 12;
$arCatalog = CCatalog::GetByID($IBlockOffersCatalogId);


$IBlockCatalogId = $arCatalog['PRODUCT_IBLOCK_ID']; // ID инфоблока товаров
$SKUPropertyId = $arCatalog['SKU_PROPERTY_ID'];

Assg\Import\Helper::m2l($IBlockCatalogId);;
Assg\Import\Helper::m2l($SKUPropertyId);
Assg\Import\Helper::stop();*/

/**
 * End test block
 */
Assg\Import\Helper::m2l("Определяем ресурсы для инициализации");
switch ($SITE_NAME_ABBR) {
    case "PR":
        $objElement = new Assg\Import\primalineaElement($IBLOCK_ID);
        break;
    case "AV":
        $objElement = new Assg\Import\avigalElement($IBLOCK_ID);
        break;
    case "LX":
        $objElement = new Assg\Import\luxuryElement($IBLOCK_ID);
        break;
    case "ST":
        break;
    default:

        Assg\Import\Helper::m2l("Класс отсутствует");
        Assg\Import\Helper::stop();
        break;
}
if($SITE_NAME_ABBR!="ST") {
    if (is_object($objElement)) {
        $MARKUP = doubleval($MARKUP);
        if (isset($MARKUP) && is_double($MARKUP)) {
            Assg\Import\Helper::m2l("Устанавливаем множитель наценки в " . $MARKUP);
            $objElement::setMarkup($MARKUP);
        }
    }

    /**
     *
     * @var array $arProfileImport
     */
    $arProfileImport = CCatalogImport::GetByID($PROFILE_ID);

    if ($arProfileImport == false) {
        $strImportErrorMessage .= "Импорт не обнаружен";
        Assg\Import\Helper::m2l("Импорт не обнаружен");
        Assg\Import\Helper::stop();
        return;
    }
    /**
     * File for import
     * @var string $DATA_FILE_NAME
     */
    Assg\Import\Helper::m2l("Проверяем файл");
    $DATA_FILE_NAME = "";

    /**
     * Start chek files
     */
    if (strlen($URL_DATA_FILE) > 0) {
        $URL_DATA_FILE = Rel2Abs("/", $URL_DATA_FILE);
        if (file_exists($_SERVER["DOCUMENT_ROOT"] . $URL_DATA_FILE) && is_file($_SERVER["DOCUMENT_ROOT"] . $URL_DATA_FILE))
            $DATA_FILE_NAME = $URL_DATA_FILE;
    }

    $strSizeServerFile = 0;
    $strSizeNewFile = 0;

    $strSizeServerFile = filesize($_SERVER["DOCUMENT_ROOT"] . $DATA_FILE_NAME);
    $strSizeNewFile = Assg\Import\Helper::getRemoteFileSize($LINK_FILE);

    if (0 >= $strSizeServerFile && 0 >= $strSizeServerFile) {
        $strImportErrorMessage .= "Импорт не возможен, нет файла" . $EOL;
        Assg\Import\Helper::m2l("Импорт прекращен, не обнаружены файлы");
        Assg\Import\Helper::stop();
        return;
    }

    if ($strSizeServerFile != $strSizeNewFile && 0 < $strSizeNewFile) {
        $bNewFile = false;


        $strRequestTime = time();
        $strPath = '/upload/catalog/' . $strRequestTime . '_catalog.xml';
        $strFullPath = $_SERVER['DOCUMENT_ROOT'] . $strPath;
        //var_dump(file_get_contents($LINK_FILE));

        if (!$file = file_get_contents($LINK_FILE)) {
            $strImportErrorMessage = "Новый файл не получен";
        } else {
            file_put_contents($strFullPath, file_get_contents($LINK_FILE));
            if (file_exists($strFullPath) && is_file($strFullPath) &&
                $APPLICATION->GetFileAccessPermission($strFullPath) >= "R") {
                unlink($_SERVER["DOCUMENT_ROOT"] . $DATA_FILE_NAME);
                $DATA_FILE_NAME = $strFullPath;
                $URL_DATA_FILE = $strPath;
                $bNewFile = true;
            } else {
                $strImportErrorMessage = "Файл не обработан";
            }
        }
        // Update profile imort
        if ($bNewFile) {
            if ($arProfileImport['SETUP_VARS'])
                parse_str($arProfileImport['SETUP_VARS'], $arOldSetupVars);


            $strSETUP_VARS = "";
            foreach ($arOldSetupVars as $key => &$val) {

                $vValue = trim($val);

                if ($key == "URL_DATA_FILE") {
                    $vValue = trim($URL_DATA_FILE);
                }
                if (strlen($strSETUP_VARS) > 0) {
                    $strSETUP_VARS .= "&";
                }

                $strSETUP_VARS .= $key . "=" . urlencode($vValue);
            }
            $NEW_PROFILE_ID = CCatalogImport::Update($PROFILE_ID, array(
                "SETUP_VARS" => $strSETUP_VARS,
                'NEED_EDIT' => 'N',
            ));
            if ($NEW_PROFILE_ID) {
                $arProfileImport["SETUP_VARS"] = $strSETUP_VARS;
            }
        }
    } elseif ($strSizeServerFile > 0 && isset($arProfileImport["LAST_USE"])) {
        $strNameFile = basename($DATA_FILE_NAME);
        $intTimestapFile = (int)preg_replace("/[^0-9]/", '', $strNameFile);
        $intTimestapLastImport = strtotime($arProfileImport["LAST_USE"]);
        if ($intTimestapFile < $intTimestapLastImport && !$DEBUG) {
            $strImportErrorMessage .= "Содержимое удаленного каталога не обновлялось с последнего импорта" . $EOL;
            Assg\Import\Helper::m2l("Содержимое удаленного каталога не обновлялось с последнего импорта");
            Assg\Import\Helper::stop();
        }
        if ($intTimestapFile < $intTimestapLastImport) {
            Assg\Import\Helper::m2l("Содержимое удаленного каталога не обновлялось с последнего импорта");
        }
    }

    /**
     * End chek file for url
     */
    Assg\Import\Helper::m2l("Получаем информацию о инфоблоке торгового каталога");
    /**
     * Get data for iblock
     */
    $resIblockTable = null;
    $arIblockProducts = array();
    $arIblockSkuProducts = array();
    $arIblock = array();
    $bAddSkuProduct = true;

    $resIblockTable = \Bitrix\Catalog\CatalogIblockTable::getList(array(
        'select' => array('*'),
        'cache' => array('ttl' => 36000),
    ));

    while ($arIblock = $resIblockTable->fetch()) {
        if ($IBLOCK_ID == $arIblock["IBLOCK_ID"]) {
            $arIblockProducts = $arIblock;
        }
        if ($IBLOCK_ID == $arIblock["PRODUCT_IBLOCK_ID"]) {
            $intSKUPropertyId = $arIblock["SKU_PROPERTY_ID"];
            $arIblockSkuProducts = $arIblock;
        }
    }

    if (empty($arIblockProducts)) {
        $strImportErrorMessage .= "Инфоблок торгового каталога не найден" . $EOL;
        Assg\Import\Helper::m2l("Инфоблок торгового каталога не найден");
        Assg\Import\Helper::stop();
        return;
    }

    if (empty($arIblockSkuProducts)) {
        Assg\Import\Helper::m2l("Не найден инфоблок торговых предложений");
        $bAddSkuProduct = false;
    }


    /**
     *    Get sections info
     */
    Assg\Import\Helper::m2l("Получаем информацию о секциях");
    $resSectionTable = null;
    $arSection = array();
    $arSections = array();
    $entitySection = \Bitrix\Iblock\Model\Section::compileEntityByIblock($IBLOCK_ID);
    $resSectionTable = $entitySection::getList(array(
        'select' => array('ID', 'NAME', 'ACTIVE', "UF_ALTERNATIVE_NAME", 'CODE'),
        'filter' => array('=IBLOCK_ID' => $IBLOCK_ID)
    ));

    while ($arSection = $resSectionTable->fetch()) {
        $arSections[] = $arSection;
    }
    /**
     * Get xml data file for imports
     */
    $xmlFile = simplexml_load_file($_SERVER["DOCUMENT_ROOT"] . $URL_DATA_FILE);

    $arXmlSections = array();
    foreach ($xmlFile->shop->categories->category as $key => $objXmlSection) {
        $arXmlSections[(string)$objXmlSection["id"]] = trim((string)$objXmlSection);
    }

    /**
     * Set xmlSectionToSiteSection
     * ID_XML => ID
     * @var array $arXmlSectToSiteSect
     */
    $arXmlSectToSiteSect = array();
    $arXmlSectToCodeSect = array();

    foreach ($arXmlSections as $intXmlId => $strXmlName) {
        if (isset($arXmlSectToSiteSect[$intXmlId]))
            continue;

        /**
         * Set for settings
         */
        foreach ($arSections as $arSection) {
            if ($arSection["NAME"] == $strXmlName
                || (in_array($strXmlName, $arSection["UF_ALTERNATIVE_NAME"]) && "Y" == $arSection["ACTIVE"])) {
                $arXmlSectToSiteSect[$intXmlId] = $arSection["ID"];
                $arXmlSectToCodeSect[$intXmlId] = $arSection["CODE"];
                continue (2);
            }
        }

        /**
         *    Add new sections
         */
        $objTmpDateTimestampX = new DateTime();
        $strCode = CUtil::translit($strXmlName, 'ru');
        $result = $entitySection::add(
            array(
                "NAME" => $strXmlName,
                "ACTIVE" => "N",
                "CODE" => $strCode,
                "IBLOCK_ID" => $IBLOCK_ID,
                "TIMESTAMP_X" => $objTmpDateTimestampX,
                "SORT" => "999"
            )
        );
        if ($result->isSuccess()) {
            $id = $result->getId();
            $arSections[] = array(
                "NAME" => $strXmlName,
                "ID" => $id,
            );
            Assg\Import\Helper::m2l("Добавлен раздел " . $strXmlName);
            $arXmlSectToSiteSect[$intXmlId] = $id;
            $arXmlSectToCodeSect[$intXmlId] = $strCode;
        } else {
            $strImportOKMessage .= 'Ошибки<pre>' . var_export($result->getErrorMessages(), true) . '</pre></br>';
        }
    }
    /**
     * Get propery for elements
     * @var array $arPropertys
     */
    $arProperty = array();
    $arProperties = array();
    $arBrandProperty = array();
    $result = \Bitrix\Iblock\PropertyTable::getList(
        array(
            "select" => array("*"),
            "filter" => array(
                "IBLOCK_ID" => $IBLOCK_ID
            ),
        )
    );
    while ($arProperty = $result->fetch()) {
        $arProperties[] = $arProperty;
        if (isset($arProperty["CODE"])
            && "BRAND" == $arProperty["CODE"]
            && "S" == $arProperty["PROPERTY_TYPE"]
            && "directory" == $arProperty["USER_TYPE"]) {
            $arBrandProperty = $arProperty;
        }
    }

    /**
     * Get table for property brand
     */
    if (!empty($arBrandProperty)) {
        $arBrandPropertySettings = unserialize($arBrandProperty["USER_TYPE_SETTINGS"]);

        if (0 < strlen($arBrandPropertySettings["TABLE_NAME"]))
            $result = \Bitrix\Highloadblock\HighloadBlockTable::getList(
                array(
                    'filter' => array('TABLE_NAME' => $arBrandPropertySettings["TABLE_NAME"])
                ));
        if (!($hldata = $result->fetch())) {
            Assg\Import\Helper::m2l('Инфоблок не найден');
        } else {
            $hlBrandEntity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
            $hlBrandClass = $hldata['NAME'] . 'Table';
            $result = $hlBrandClass::getList(
                array(
                    'filter' => array("*"),
                    'select' => array("*"),
                    'order' => array(
                        'UF_XML_ID' => 'asc'
                    ),
                )
            );
            while ($arBrand = $result->fetch()) {
                $arBrands[$arBrand["UF_XML_ID"]] = $arBrand["ID"];
            }
        }
    }

    $objIBlockElement = new CIBlockElement();
    /**
     * Get elemenets for site
     */
    /**
     * All elements before import
     * XML_ID => ID
     * @global array $arElements
     */
    Assg\Import\Helper::m2l("Получаем информацию о элементах на сайте");
    $arElements = array();
    $arElement = array();

    $tmpIBLOCK_ID = array($IBLOCK_ID);
//$tmpIBLOCK_ID = array();

    if ($bAddSkuProduct) {
        $tmpIBLOCK_ID[] = $arIblockSkuProducts["IBLOCK_ID"];
    }

    $objElementSite = \Bitrix\Iblock\ElementTable::getList(array(
        'select' => array('ID', 'XML_ID'),
        'filter' => array('IBLOCK_ID' => $tmpIBLOCK_ID, 'XML_ID' => $objElement::prefix . '_%'),
        'cache' => array('ttl' => 36000, 'cache_joins' => true),

    ));
    while ($arElement = $objElementSite->fetch()) {
        $arElements[$arElement["XML_ID"]] = $arElement["ID"];
        if ($objIBlockElement->Update($arElement["ID"], array("ACTIVE" => "N"))) {

        } else {

        }
    }

    Assg\Import\Helper::m2l("Получаем информацию о товарах на сайте");
    $arProducts = array();
    $arProduct = array();

    $objProductSite = \Bitrix\Catalog\ProductTable::getList(array(
        'select' => array('ID', 'AVAILABLE'),
        'filter' => array('=ID' => array_column($arElements, null)),
        'cache' => array('ttl' => 36000, 'cache_joins' => true),
    ));
    while ($arProduct = $objProductSite->fetch()) {
        $arProducts[$arProduct["ID"]] = $arProduct["AVAILABLE"];
    }

    Assg\Import\Helper::m2l("Получаем базовую цену");
    $objPriceTable = GroupTable::getList(array(
            'select' => array('*'),
            'filter' => array('BASE' => 'Y'))
    );
    /**
     *
     * @var array $arBasePrice
     */
    $arBasePrice = $objPriceTable->fetch();
    $PRICE_ID = $arBasePrice["ID"];

//Assg\Import\Helper::m2l($PRICE_ID);
//print_r($arElements);
    Assg\Import\Helper::m2l("Получаем цены загруженных товаров");
    /**
     * Get all products price
     * PRODUCT_ID => array ("ID" => (int), "VALUE" => (float))
     * @var array $arPricesProduct
     */
    $arPricesProduct = array();
    $result = PriceTable::getList(array(
            'select' => array('*'),
            'filter' => array('PRODUCT_ID' => array_column($arElements, null), 'CATALOG_GROUP_ID' => $PRICE_ID),
            'cache' => array('ttl' => 36000),
        )
    );
    while ($arPrice = $result->fetch()) {
        $arPricesProduct[$arPrice["PRODUCT_ID"]] = $arPrice["ID"];
    }
//print_r($arPricesProduct);
//Assg\Import\Helper::stop();
    /**
     * Get items for imort
     */
    $arNewElements = array();
    $arUpdateElements = array();
    $arErrorElements = array();
    $i = 0;
    Assg\Import\Helper::m2l("Запускаем работу с продуктами");
    foreach ($xmlFile->shop->offers->offer as $key => $objXmlOffer) {
        $i++;
        Assg\Import\Helper::m2l("Обработка продукта №" . $i);

        $arData = &$objXmlOffer;

        $objElement->setXmlData($arData);
        $objElement->initData();
        $intXmlCategory = (int)$objXmlOffer->categoryId;

        $arElementProduct = $objElement->getFields();
        /*
         * Set id section for element
         */
        $arElementProduct["IBLOCK_SECTION_ID"] = $arXmlSectToSiteSect[$intXmlCategory];


        $strBrand = $objElement->getBrand();
        $strXmlBrand = CUtil::translit($strBrand, "ru");
        if (isset($arBrands[$strXmlBrand])) {
            $objElement->SetDynamicProp("BRAND", $strXmlBrand);
            //Assg\Import\Helper::m2l($strBrand." найден");
        } else {
            $result = $hlBrandClass::add(
                array(
                    "UF_NAME" => $strBrand,
                    "UF_XML_ID" => $strXmlBrand,
                )
            );
            if ($result->isSuccess()) {
                $objElement->SetDynamicProp("BRAND", $strXmlBrand);
                $arBrands[$strXmlBrand] = $result->getId();
                Assg\Import\Helper::m2l("Добавлен производитель " . $strBrand);
            } else {
                Assg\Import\Helper::m2l("Ошибка при добавлении производителя " . $strBrand);
                Assg\Import\Helper::m2l(var_export($result->getErrorMessages(), true));
            }
        }
        $arElementProduct['CODE'] = CUtil::translit($arElementProduct["NAME"], "ru");

        if (isset($arElements[$arElementProduct["XML_ID"]])) {
            $PRODUCT_ID = $arElements[$arElementProduct["XML_ID"]];
            if ($objIBlockElement->Update($arElements[$arElementProduct["XML_ID"]], $arElementProduct)) {
                Assg\Import\Helper::setLogElement("U", $PRODUCT_ID, "FIELDS");
                $arUpdateElements[$PRODUCT_ID] = array(
                    "XML_ID" => $arElements[$arElementProduct["XML_ID"]],
                );
            } else {
                Assg\Import\Helper::setLogElement("E", $PRODUCT_ID, "FIELDS", $objIBlockElement->LAST_ERROR);
                $strImportErrorMessage .= $objIBlockElement->LAST_ERROR . $EOL;
                Assg\Import\Helper::m2l(print_r($objIBlockElement->LAST_ERROR, true));
            }
        } else {
            $arElementProduct["IBLOCK_ID"] = $IBLOCK_ID;
            if ($PRODUCT_ID = $objIBlockElement->Add($arElementProduct)) {
                Assg\Import\Helper::setLogElement("A", $PRODUCT_ID, "FIELDS");
                $arElements[$arElementProduct["XML_ID"]] = $PRODUCT_ID;
            } else {
                Assg\Import\Helper::setLogElement("E", $arElementProduct["XML_ID"], "FIELDS", $objIBlockElement->LAST_ERROR);
                Assg\Import\Helper::m2l(print_r($objIBlockElement->LAST_ERROR, true));
                continue;
            }

        }
        $objElement->setArticle($arXmlSectToCodeSect[$intXmlCategory], $PRODUCT_ID);

        $typeProduct = \Bitrix\Catalog\ProductTable::TYPE_PRODUCT;

        if ($bAddSkuProduct && $objElement->isSKU()) {
            $typeProduct = \Bitrix\Catalog\ProductTable::TYPE_SKU;
        }
        Assg\Import\Helper::m2l(var_export($bAddSkuProduct, true));
        Assg\Import\Helper::m2l(var_export($objElement->isSKU(), true));
        //Assg\Import\Helper::stop();
        //Add product
        if ($typeProduct != \Bitrix\Catalog\ProductTable::TYPE_SKU) {
            if (isset($arProducts[$PRODUCT_ID])) {
                $result = \Bitrix\Catalog\ProductTable::update($PRODUCT_ID, array(
                    'QUANTITY_TRACE' => \Bitrix\Catalog\ProductTable::STATUS_DEFAULT,
                    "TYPE" => $typeProduct,
                    "PURCHASING_PRICE" => $objElement->getPrice(),
                    'AVAILABLE' => Bitrix\Catalog\ProductTable::STATUS_YES,
                    'QUANTITY' => 0,
                    'QUANTITY_TRACE' => Bitrix\Catalog\ProductTable::STATUS_YES,
                    'CAN_BUY_ZERO' => Bitrix\Catalog\ProductTable::STATUS_YES
                ));
                if ($result->isSuccess()) {

                } else {
                    $strImportErrorMessage .= 'Ошибки при обновлении продукта ' . $PRODUCT_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre></br>';
                    Assg\Import\Helper::m2l('Ошибки при обновлении продукта ' . $PRODUCT_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre>');
                }
            } else {

                $result = \Bitrix\Catalog\ProductTable::add(array(
                    "ID" => $PRODUCT_ID,
                    'QUANTITY_TRACE' => \Bitrix\Catalog\ProductTable::STATUS_DEFAULT,
                    "TYPE" => $typeProduct,
                    "PURCHASING_PRICE" => $objElement->getPrice(),
                    'AVAILABLE' => Bitrix\Catalog\ProductTable::STATUS_YES,
                    'QUANTITY' => 0,
                    'QUANTITY_TRACE' => Bitrix\Catalog\ProductTable::STATUS_YES,
                    'CAN_BUY_ZERO' => Bitrix\Catalog\ProductTable::STATUS_YES
                ));

                if ($result->isSuccess()) {
                    $arProducts[$PRODUCT_ID] = Bitrix\Catalog\ProductTable::STATUS_YES;
                } else {
                    $strImportErrorMessage .= 'Ошибки при добавлении продукта ' . $PRODUCT_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre></br>';
                    Assg\Import\Helper::m2l('Ошибки при добавлении продукта ' . $PRODUCT_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre>');
                }

            }
        } //Add sku
        else {
            $arSKU = $objElement->getArSKU();
            Assg\Import\Helper::m2l(print_r($arSKU, true));

            foreach ($arSKU as $xmlId => $arSKUEl) {
                $arSKUProperties = array(
                    $intSKUPropertyId => $PRODUCT_ID,
                    $arSKUEl["CODE"] => $arSKUEl["VALUE"],
                );
                $arSKUElement = array(
                    "IBLOCK_ID" => $arIblockSkuProducts["IBLOCK_ID"],
                    "XML_ID" => $xmlId,
                    "NAME" => $arElementProduct["NAME"] . " " . $arSKUEl["NAME"] . " " . $arSKUEl["VALUE"],
                    "PROPERTY_VALUES" => $arSKUProperties,
                    "ACTIVE" => "Y"
                );
                Assg\Import\Helper::m2l(print_r($arSKUElement, true));
                if (isset($arElements[$xmlId])) {
                    $PRODUCT_SKU_ID = $arElements[$xmlId];
                    if ($objIBlockElement->Update($arElements[$xmlId], $arSKUElement)) {
                        $result = \Bitrix\Catalog\ProductTable::update($arElements[$xmlId], array(
                            'QUANTITY_TRACE' => \Bitrix\Catalog\ProductTable::STATUS_DEFAULT,
                            "TYPE" => \Bitrix\Catalog\ProductTable::TYPE_OFFER,
                            "PURCHASING_PRICE" => $objElement->getPrice(),
                            'AVAILABLE' => Bitrix\Catalog\ProductTable::STATUS_YES,
                            'QUANTITY' => 0,
                            'QUANTITY_TRACE' => Bitrix\Catalog\ProductTable::STATUS_YES,
                            'CAN_BUY_ZERO' => Bitrix\Catalog\ProductTable::STATUS_YES
                        ));

                    } else {

                    }
                } else {
                    if ($PRODUCT_SKU_ID = $objIBlockElement->Add($arSKUElement)) {
                        //Assg\Import\Helper::setLogElement ("A", $PRODUCT_ID, "FIELDS");
                        $arElements[$xmlId] = $PRODUCT_SKU_ID;
                        $result = \Bitrix\Catalog\ProductTable::add(array(
                            "ID" => $PRODUCT_SKU_ID,
                            'QUANTITY_TRACE' => \Bitrix\Catalog\ProductTable::STATUS_DEFAULT,
                            "TYPE" => \Bitrix\Catalog\ProductTable::TYPE_OFFER,
                            "PURCHASING_PRICE" => $objElement->getPrice(),
                            'AVAILABLE' => Bitrix\Catalog\ProductTable::STATUS_YES,
                            'QUANTITY' => 0,
                            'QUANTITY_TRACE' => Bitrix\Catalog\ProductTable::STATUS_YES,
                            'CAN_BUY_ZERO' => Bitrix\Catalog\ProductTable::STATUS_YES
                        ));
                    } else {
                        Assg\Import\Helper::setLogElement("E", $arElementProduct["XML_ID"], "FIELDS", $objIBlockElement->LAST_ERROR);
                        //Assg\Import\Helper::m2l($arElementProduct["XML_ID"], "FIELDS", $objIBlockElement->LAST_ERROR
                        continue;
                    }


                }
                if (isset($arPricesProduct[$PRODUCT_SKU_ID])) {

                    $result = PriceTable::update($arPricesProduct[$PRODUCT_SKU_ID], array(
                        'PRICE' => $objElement->getBasePrice(),
                        'PRICE_SCALE' => $objElement->getBasePrice(),
                    ));
                    if ($result->isSuccess()) {
                        Assg\Import\Helper::m2l('Обновлена цена ' . $arPricesProduct[$PRODUCT_SKU_ID] . ' торгового предложения ' . $PRODUCT_SKU_ID . ' = ' . $objElement->getBasePrice());
                    } else {
                        $strImportErrorMessage .= 'Ошибки при торгового предложения цены продукта ' . $PRODUCT_SKU_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre></br>';
                        Assg\Import\Helper::m2l('Ошибки при торгового предложения цены продукта ' . $PRODUCT_SKU_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre>');
                    }

                } else {
                    $result = PriceTable::add(array(
                            'PRODUCT_ID' => $PRODUCT_SKU_ID,
                            'CATALOG_GROUP_ID' => $PRICE_ID,
                            'PRICE' => $objElement->getBasePrice(),
                            'PRICE_SCALE' => $objElement->getBasePrice(),
                            'CURRENCY' => 'RUB')
                    );
                    if ($result->isSuccess()) {
                        $arPricesProduct[$PRODUCT_SKU_ID] = $result->getId();
                        Assg\Import\Helper::m2l('Добавлена цена ' . $result->getId() . ' торгового предложения ' . $PRODUCT_SKU_ID . ' = ' . $objElement->getBasePrice());
                    } else {
                        $strImportErrorMessage .= 'Ошибки при добавлении цены торгового предложения ' . $PRODUCT_SKU_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre></br>';
                        Assg\Import\Helper::m2l('Ошибки при добавлении цены торгового предложения ' . $PRODUCT_SKU_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre>');
                    }
                }
            }
            /* if (isset($arElements[$arElementProduct["XML_ID"]]))
            {

            } */
            //$objIBlockElement
            //$SKUPropertyId
        }
        /* Assg\Import\Helper::m2l("End");
        Assg\Import\Helper::stop(); */
        /**
         * Set price for product
         */

        if (isset($arPricesProduct[$PRODUCT_ID])) {

            $result = PriceTable::update($arPricesProduct[$PRODUCT_ID], array(
                'PRICE' => $objElement->getBasePrice(),
                'PRICE_SCALE' => $objElement->getBasePrice(),
            ));
            if ($result->isSuccess()) {
                Assg\Import\Helper::m2l('Обновлена цена ' . $arPricesProduct[$PRODUCT_ID] . ' продукта' . $PRODUCT_ID . ' = ' . $objElement->getBasePrice());
            } else {
                $strImportErrorMessage .= 'Ошибки при обновлении цены продукта ' . $PRODUCT_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre></br>';
                Assg\Import\Helper::m2l('Ошибки при обновлении цены продукта ' . $PRODUCT_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre>');
            }

        } else {
            $result = PriceTable::add(array(
                    'PRODUCT_ID' => $PRODUCT_ID,
                    'CATALOG_GROUP_ID' => $PRICE_ID,
                    'PRICE' => $objElement->getBasePrice(),
                    'PRICE_SCALE' => $objElement->getBasePrice(),
                    'CURRENCY' => 'RUB')
            );
            if ($result->isSuccess()) {
                $arPricesProduct[$PRODUCT_ID] = $result->getId();
                Assg\Import\Helper::m2l('Добавлена цена ' . $result->getId() . ' продукта' . $PRODUCT_ID . ' = ' . $objElement->getBasePrice());
            } else {
                $strImportErrorMessage .= 'Ошибки при добавлении цены продукта ' . $PRODUCT_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre></br>';
                Assg\Import\Helper::m2l('Ошибки при добавлении цены продукта ' . $PRODUCT_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre>');
            }
        }
        $arElementProductProperies = $objElement->getProperties();
        CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, $IBLOCK_ID, $arElementProductProperies);
        //Assg\Import\Helper::stop();

        if ($i == 20) {

            sleep(1);
        }
    }
}
/*Stile-n import*/
else {


    require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/csv_data.php");


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
    $BRAND_NAME="Marina";

    $count_step=0;
    $PRODUCT_SKU_ID=0;
    $ID=0;
    $arFiles=[];
    $IdSection=0;
    $Flag_exist_elem=0;

    $errProduct=[];
    /*Read csv file*/
    $csvFile = new CCSVData('R', true);

    $arRawFiles=scandir($_SERVER["DOCUMENT_ROOT"].$PATH_TO_FOLDER);


//    p("\n".$LINK_FILE);
//    p("\n".$MARKUP);

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


        $section = Bitrix\Iblock\SectionTable::getRow([
            'select' => [
                'ID',
            ],
            'filter' => [
                '=CODE' => $code,
            ],
        ]);
        if($section!==null)
        {
            $res = $bSection->Update($element['ID'], $arFields);
        }
        else
        {
            $IdSection = $bSection->Add($arFields);
            $res = ($IdSection>0);
        }
        if(!$res)
            echo $bSection->LAST_ERROR;

        $idSection=0;

        while ($row = $csvFile->Fetch()) {
            if(false===file_get_contents($row[$URL_STILE_N])){

                continue;
            }

            $bs = new CIBlockElement();

            $nameProduct= $BRAND_NAME." ".$row[$NAME];

            $arFields = array(
                "ACTIVE" => "Y",
                "CODE" =>CUtil::translit($row[$NAME],"ru"),
                "IBLOCK_ID" => $IdCatalog,
                "IBLOCK_SECTION_ID" => $IdSection,
                "NAME" => $nameProduct,
                "SORT" => 999,
                "DETAIL_PICTURE" => CFile::MakeFileArray($row[$PIC_DETAIL]),
                "PREVIEW_TEXT" => $row[$DESCRIPTION],
                "PREVIEW_TEXT_TYPE" => "text",
                "XML_ID" => CUtil::translit($row[$NAME],"ru"),
                "PREVIEW_PICTURE" => CFile::MakeFileArray($row[$PIC_PREVIEW]),

            );
            $element = Bitrix\Iblock\ElementTable::getRow([
                'select' => [
                    'ID',
                ],
                'filter' => [
                    '=CODE' => CUtil::translit($row[$NAME],"ru"),
                ],
            ]);
            if($element!==null)
            {
                $res = $bs->Update($element['ID'], $arFields);
                $ID = $element['ID'];
                $Flag_exist_elem=1;
            }
            else
            {
                $ID = $bs->Add($arFields);
                $res = ($ID>0);
                $Flag_exist_elem=0;
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


                if($Flag_exist_elem){
                    $result = \Bitrix\Catalog\ProductTable::update($PRODUCT_SKU_ID, array(
                        'QUANTITY_TRACE' => \Bitrix\Catalog\ProductTable::STATUS_DEFAULT,
                        "TYPE" => \Bitrix\Catalog\ProductTable::TYPE_OFFER,
                        "PURCHASING_PRICE" => $row[$PRICE],
                        'AVAILABLE' => Bitrix\Catalog\ProductTable::STATUS_YES,
                        'QUANTITY' => 0,
                        'QUANTITY_TRACE' => Bitrix\Catalog\ProductTable::STATUS_YES,
                        'CAN_BUY_ZERO' => Bitrix\Catalog\ProductTable::STATUS_YES
                    ));
                }
                else {
                    if ($PRODUCT_SKU_ID = $bs->Add($arSKUElement)) {

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

                    if ($result->isSuccess()) {
                        echo Bitrix\Catalog\ProductTable::STATUS_YES;
                    } else {
                        $strImportErrorMessage .= 'Ошибки при добавлении продукта ' . $PRODUCT_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre></br>';
                        Assg\Import\Helper::m2l('Ошибки при добавлении продукта ' . $PRODUCT_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre>');
                    }
                }
            }

            if($Flag_exist_elem){
                $result = PriceTable::update($PRODUCT_SKU_ID, array(
                    'PRICE' => floor($row[$PRICE]*$MARKUP),
                    'PRICE_SCALE' => floor($row[$PRICE]*$MARKUP),
                ));
                if ($result->isSuccess()) {
                   // Assg\Import\Helper::m2l('Обновлена цена ' . $arPricesProduct[$PRODUCT_ID] . ' продукта' . $PRODUCT_ID . ' = ' . $objElement->getBasePrice());
                } else {
                    $strImportErrorMessage .= 'Ошибки при обновлении цены продукта ' . $PRODUCT_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre></br>';
                    Assg\Import\Helper::m2l('Ошибки при обновлении цены продукта ' . $PRODUCT_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre>');
                }
            }
            else {
                $result = PriceTable::add(array(
                        'PRODUCT_ID' => $PRODUCT_SKU_ID,
                        'CATALOG_GROUP_ID' => $CATALOG_GROUP_ID,
                        'PRICE' => floor($row[$PRICE]*$MARKUP),
                        'PRICE_SCALE' => floor($row[$PRICE]*$MARKUP),
                        'CURRENCY' => 'RUB',
                    )
                );
                if ($result->isSuccess()) {

                } else {
                    $strImportErrorMessage .= 'Ошибки при добавлении цены торгового предложения ' . $PRODUCT_SKU_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre></br>';
               //     Assg\Import\Helper::m2l('Ошибки при добавлении цены торгового предложения ' . $PRODUCT_SKU_ID . '<pre>' . var_export($result->getErrorMessages(), true) . '</pre>');
                }
            }
            CIBlockElement::SetPropertyValuesEx($ID,$IdCatalog,array("BRAND"=>$BRAND));
//            p("\n######## ".$count_step);
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

}
//$INTERNAL_VARS_LIST = "tmpid,line_num,correct_lines,error_lines,killed_lines,arIBlockProperty,bThereIsGroups,arProductGroups,arIBlockPropertyValue,bDeactivationStarted,bUpdatePrice";

/*$сache = Bitrix\Main\Data\Cache::createInstance();
 if ($сache->initCache($cacheTime, $cacheId, $cacheDir)){
 $result = $сache->getVars();
 }elseif ($сache->startDataCache()){
 $result = array();
 // ...
 if ($isInvalid)
 {
 $cache->abortDataCache();
 }
 // ...
 $сache->endDataCache($result);
 }  */

/* for ($i = 0; $i < $NUM_FIELDS; $i++)
	$SETUP_VARS_LIST .= ",field_".$i; */
//$strImportOKMessage .= '<pre>'.var_export($_REQUEST, true).'</pre></br>';
//$strImportOKMessage .= '<pre>'.var_export($PROFILE_ID, true).'</pre></br>';
//$strImportOKMessage .= '<pre>'.var_export($objElement, true).'</pre></br>';
//$strImportOKMessage .= '<pre>'.var_export($SETUP_FIELDS_LIST, true).'</pre></br>';
//$strImportOKMessage .= '<pre>'.var_export($PROFILE_ID, true).'</pre></br>';
//$strImportOKMessage .= '<pre>'.var_export(get_defined_vars(), true).'</pre></br>';
/* $strImportOKMessage .= $DATA_FILE_NAME;

$strImportOKMessage .= str_replace("#TIME#", RoundEx(getmicrotime() - $startImportExecTime, 2),
	GetMessage("CICML_LOAD_TIME")) . "<br>";
$strImportOKMessage .= str_replace("#NUM#", ($STT_CATALOG_UPDATE + $STT_CATALOG_ADD), GetMessage("CICML_LOAD_CATALOG")) .
	 " ";
$strImportOKMessage .= str_replace("#NUM_UPD#", $STT_CATALOG_UPDATE,
	str_replace("#NUM_NEW#", $STT_CATALOG_ADD, GetMessage("CICML_LOAD_NEW_UPD"))) . " ";

if (IntVal($STT_CATALOG_ERROR) > 0)
	$strImportOKMessage .= str_replace("#NUM#", $STT_CATALOG_ERROR, GetMessage("CICML_LOAD_ERROR"));
$strImportOKMessage .= "<br>";

$strImportOKMessage .= str_replace("#NUM#", ($STT_GROUP_UPDATE + $STT_GROUP_ADD), GetMessage("CICML_LOAD_GROUP")) . " ";
$strImportOKMessage .= str_replace("#NUM_UPD#", $STT_GROUP_UPDATE,
	str_replace("#NUM_NEW#", $STT_GROUP_ADD, GetMessage("CICML_LOAD_GROUP_NEW_UPD"))) . " ";

if (IntVal($STT_GROUP_ERROR) > 0)
	$strImportOKMessage .= str_replace("#NUM#", $STT_GROUP_ERROR, GetMessage("CICML_LOAD_GROUP_ERROR"));
$strImportOKMessage .= "<br>";

$strImportOKMessage .= str_replace("#NUM#", ($STT_PROP_UPDATE + $STT_PROP_ADD), GetMessage("CICML_LOAD_PROPS")) . " ";
$strImportOKMessage .= str_replace("#NUM_UPD#", $STT_PROP_UPDATE,
	str_replace("#NUM_NEW#", $STT_PROP_ADD, GetMessage("CICML_LOAD_PROPS_NEW_UPD"))) . " ";

if (IntVal($STT_PROP_ERROR) > 0)
	$strImportOKMessage .= str_replace("#NUM#", $STT_PROP_ERROR, GetMessage("CICML_LOAD_PROPS_ERROR"));
$strImportOKMessage .= "<br>";

$strImportOKMessage .= str_replace("#NUM#", ($STT_PRODUCT_UPDATE + $STT_PRODUCT_ADD), GetMessage("CICML_LOAD_PROD")) .
	 " ";
$strImportOKMessage .= str_replace("#NUM_UPD#", $STT_PRODUCT_UPDATE,
	str_replace("#NUM_NEW#", $STT_PRODUCT_ADD, GetMessage("CICML_LOAD_PROD_NEW_UPD"))) . " ";

if (IntVal($STT_PRODUCT_ERROR) > 0)
	$strImportOKMessage .= str_replace("#NUM#", $STT_PRODUCT_ERROR, GetMessage("CICML_LOAD_PROD_ERROR"));
$strImportOKMessage .= "<br>"; */



