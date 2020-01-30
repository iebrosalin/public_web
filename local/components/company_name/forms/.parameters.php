<?
if ( ! defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) {
	die();
}

if ( ! CModule::IncludeModule( "iblock" ) ) {
	return;
}

$rsIBlockType = CIBlockType::GetList( array( "sort" => "asc" ), array( "ACTIVE" => "Y" ) );
while ( $arr = $rsIBlockType->Fetch() ) {
	if ( $ar = CIBlockType::GetByIDLang( $arr["ID"], LANGUAGE_ID ) ) {
		$arIBlockType[ $arr["ID"] ] = "[" . $arr["ID"] . "] " . $ar["NAME"];
	}
}

$rsIBlock = CIBlock::GetList( Array( "sort" => "asc" ), Array( "TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE" => "Y" ) );
while ( $arr = $rsIBlock->Fetch() ) {
	$arIBlock[ $arr["ID"] ] = "[" . $arr["ID"] . "] " . $arr["NAME"];
}

$arComponentParameters = array(
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT"  => "BASE",
			"NAME"    => GetMessage( "F_IBLOCK_TYPE" ),
			"TYPE"    => "LIST",
			"VALUES"  => $arIBlockType,
			"REFRESH" => "Y",
			"DEFAULT" => "altasib_feedback",
		),
		"IBLOCK_ID"   => array(
			"PARENT"            => "BASE",
			"NAME"              => GetMessage( "F_IBLOCK_ID" ),
			"TYPE"              => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES"            => $arIBlock,
			"REFRESH"           => "Y",
			"DEFAULT"           => $defaultIBid,
		),
		"CACHE_TIME"  => array(
			"DEFAULT" => 86400
		),
	)
);
