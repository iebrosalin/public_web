<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use \Bitrix\Main\Loader;
if (!Loader::IncludeModule('iblock')) {
    jsonError('Ошибка подключения модуля инфоблоков');
}

if(checkForm($_POST)) die();

$arFields = array (
    'IBLOCK_ID' => intval($_POST['iblock_id']),
    'NAME' => 'Обратная связь от '.htmlspecialchars($_POST['name']),
    'PROPERTY_VALUES' => array (
        'NAME' => $_POST['name'],
        'PHONE' => $_POST['phone'],
        'EMAIL' => $_POST['email'],
        'MESSAGE' => $_POST['feedback_text'],
    )
);

$oEl = new CIBlockElement();
$ID = $oEl->Add($arFields);
if (0 >= $ID) {
    jsonError(ERROR_MESSAGE_BITRIX_FAIL );
}

echo json_encode([
    'message'=>'Заявка успешно создана.',
    'header'=>'Форма обратной связи',
]);


$arFields = array(
    'NAME' => $arFields ['PROPERTY_VALUES'] ['NAME'],
    'PHONE' => $arFields ['PROPERTY_VALUES'] ['PHONE'],
    'EMAIL' => $arFields ['PROPERTY_VALUES'] ['EMAIL'],
    'MESSAGE' => $arFields ['PROPERTY_VALUES'] ['MESSAGE'],
);

$ID = CEvent::Send("BR_FEEDBACK", SITE_ID, $arFields);

if (0 >= $ID) {
    jsonError( ERROR_MESSAGE_BITRIX_FAIL );
}

die();
