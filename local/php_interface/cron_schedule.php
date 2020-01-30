#!/usr/bin/php7.0
<?php
/* replace #PHP_PATH# to real path of php binary
For example:
/user/bin/php
/usr/bin/perl
/usr/bin/env python
*/

$_SERVER["DOCUMENT_ROOT"] = "....."; // replace #DOCUMENT_ROOT# to real document root path

$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
$siteID = 's1'; // replace #SITE_ID# to your real site ID - need for language ID

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS",true);
define("BX_CAT_CRON", true);
define('NO_AGENT_CHECK', true);

if (preg_match('/^[a-z0-9_]{2}$/i', $siteID) === 1)

{
	define('SITE_ID', $siteID);
}
else
{
	die('No defined site - $siteID');
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $DB;
global $USER;
$USER = new CUser;
$USER->Authorize(1);
//
if (!defined('LANGUAGE_ID') || preg_match('/^[a-z]{2}$/i', LANGUAGE_ID) !== 1)
	die('Language id is absent - defined site is bad');

set_time_limit(0);

if ( ! CModule::IncludeModule( "iblock" ) ) {
    return;
}
$arSelect=[
    'ID',
    //'PROPERTY_REPEAT',
    'DATE_ACTIVE_TO','NAME'
];
$arFilter=[
    'IBLOCK_ID' => 9, //ID - schedule
    'ACTIVE' => 'Y',
   '!PROPERTY_REPEAT'=>'',
];

$res = CIBlockElement::GetList(
    array('DATE_ACTIVE_TO' => 'DESC'),
    $arFilter,
    false,
    false,
    $arSelect
);

$arRes=[];
$beforeRes=[];
$arErr=[];
$element=new CIBlockElement();




for ($i = 1; $arItem = $res->GetNext(); ++$i) {
        $beforeRes  =['Item'=>$arItem, 'Err'=>$element->LAST_ERROR];
        $t=nextDateSchedule($arItem);
        $element->Update($arItem['ID'],['DATE_ACTIVE_TO'=>$t]);
        $arRes[]=['Item'=>$arItem, 'Err'=>$element->LAST_ERROR];
}