<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use \Bitrix\Main\Loader;
if (!Loader::IncludeModule('iblock')) {
    jsonError(ERROR_MESSAGE_BITRIX_FAIL);
}

//p_f($_POST);

$arFields = array (
    'IBLOCK_ID' => intval($_POST['iblock_id']),
    'NAME' => 'Заявка на звонок от '.htmlspecialchars($_POST['name']),
    'PROPERTY_VALUES' => array (
        'NAME' => $_POST['name'],
        'PHONE' => $_POST['phone'],
    )
);

$oEl = new CIBlockElement();
$ID = $oEl->Add($arFields);
if (0 >= $ID) {
    jsonError(ERROR_MESSAGE_BITRIX_FAIL );
}

echo json_encode([
    'message'=>'Заявка успешно создана.',
    'header'=>'Форма заказа звонка',
]);

$arFields = $arFields ['PROPERTY_VALUES'];

$ID = CEvent::Send("BR_CALLBACK", SITE_ID, $arFields);

if (0 >= $ID) {
    jsonError( ERROR_MESSAGE_BITRIX_FAIL );
}
die();
