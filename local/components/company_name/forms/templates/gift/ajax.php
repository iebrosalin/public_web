<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use \Bitrix\Main\Loader;
if (!Loader::IncludeModule('iblock')) {
    jsonError(ERROR_MESSAGE_BITRIX_FAIL);
}

if(checkForm($_POST)) die();

$arFields = array (
    'IBLOCK_ID' => intval($_POST['iblock_id']),
    'NAME' => 'Хочет получить подарок ' . htmlspecialchars($_POST['name']),
    'PROPERTY_VALUES' => array (
        'NAME' => $_POST['name'],
        'PHONE' => $_POST['phone'],
        'EMAIL' => $_POST['email'],
    )
);

$oEl = new CIBlockElement();
$ID = $oEl->Add($arFields);
if (0 >= $ID) {
    jsonError(ERROR_MESSAGE_BITRIX_FAIL );
}

echo json_encode([
    'message'=>'Форма отправлена.',
    'header'=>'Форма получения подарка',
]);

$arFields = array(
    'NAME' => $arFields ['PROPERTY_VALUES'] ['NAME'],
    'PHONE' => $arFields ['PROPERTY_VALUES'] ['PHONE'],
    'EMAIL' => $arFields ['PROPERTY_VALUES'] ['EMAIL'],
);

$ID = CEvent::Send("BR_GET_GIFT", SITE_ID, $arFields);

if (0 >= $ID) {
    jsonError( ERROR_MESSAGE_BITRIX_FAIL );
}
die();
