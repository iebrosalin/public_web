<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}?>
<?$APPLICATION->IncludeComponent("bitrix:map.yandex.view", "map_Person", Array(
	"CONTROLS" => array(	// Элементы управления
		),
		"INIT_MAP_TYPE" => "MAP",	// Стартовый тип карты
		"MAP_DATA" => $arResult['POINT'],// Данные, выводимые на карте
		"MAP_HEIGHT" => "400",	// Высота карты
		"MAP_ID" => "",	// Идентификатор карты
		"MAP_WIDTH" => "100%",	// Ширина карты
		"OPTIONS" => array(	// Настройки
            2 => "ENABLE_DRAGGING",
        )
	),
	false
);?>

