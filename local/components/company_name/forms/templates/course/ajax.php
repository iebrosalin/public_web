<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use \Bitrix\Main\Loader;
use Bitrix\Main\Diag\Debug;
if (!Loader::IncludeModule('iblock')) {
    jsonError('Ошибка подключения модуля инфоблоков');
}

if(checkForm($_POST)) die();

$arFields = array (
    'IBLOCK_ID' => intval($_POST['iblock_id']),
    'NAME' => 'Пожелание записаться на курс от ' . htmlspecialchars($_POST['name']),
    'PROPERTY_VALUES' => array (
        'NAME' => $_POST['name'],
        'PHONE' => $_POST['phone'],
        'EMAIL' => $_POST['email'],
        'COURSE' => $_POST['course'],
    )
);

$oEl = new CIBlockElement();
$ID = $oEl->Add($arFields);
if (0 >= $ID) {
    jsonError(ERROR_MESSAGE_BITRIX_FAIL);
}

echo json_encode([
    'message'=>'Спасибо! Ваша заявка принята. В ближайшее время с вами свяжется наш менеджер для уточнения деталей.',
    'header'=>'Спасибо!',
]);
$arFields = array(
    'NAME' => $arFields ['PROPERTY_VALUES'] ['NAME'],
    'PHONE' => $arFields ['PROPERTY_VALUES'] ['PHONE'],
    'EMAIL' => $arFields ['PROPERTY_VALUES'] ['EMAIL'],
    'COURSE' => CIBlockElement::GetList(
        array("sort" => "asc"),
        array(
            'ID'=>$arFields ['PROPERTY_VALUES'] ['COURSE'],
        ),
        false,
        false,
        array("NAME")
    )->GetNext()['NAME'],
);
$ID = CEvent::Send("BR_SIGN_COURSE", SITE_ID, $arFields);

if (0 >= $ID) {
    jsonError( ERROR_MESSAGE_BITRIX_FAIL );
}

die();
