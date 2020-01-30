<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

Bitrix\Iblock\Component\Tools::process404(
    'Не найден', //Сообщение
    true, // Нужно ли определять 404-ю константу
    true, // Устанавливать ли статус
    true, // Показывать ли 404-ю страницу
    false // Ссылка на отличную от стандартной 404-ю
);
?>
