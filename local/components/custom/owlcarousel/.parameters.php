<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

	if(!CModule::IncludeModule("iblock")) return;

	$groups = array();

	$arIBlockType = array();
	$rsIBlockType = CIBlockType::GetList(array("sort"=>"asc"), array("ACTIVE"=>"Y"));
	while ($arr=$rsIBlockType->Fetch()) {
		if($ar=CIBlockType::GetByIDLang($arr["ID"], LANGUAGE_ID)) {
			$arIBlockType[$arr["ID"]] = "[".$arr["ID"]."] ".$ar["NAME"];
		}
	}

	$arIBlock=array();
	$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
	while($arr=$rsIBlock->Fetch()) {
		$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
	}

	$arSorts = Array("ASC"=>GetMessage("STAR_OWLCAROUSEL_SORT_ASC"), "DESC"=>GetMessage("STAR_OWLCAROUSEL_SORT_DESC"));
	$arSortFields = Array(
		"ID"=>GetMessage("STAR_OWLCAROUSEL_SORT_ID"),
		"NAME"=>GetMessage("STAR_OWLCAROUSEL_SORT_NAME"),
		"SORT"=>GetMessage("STAR_OWLCAROUSEL_SORT_SORT"),
	);

	$arProperty_LNS = array();
	$rsProp = CIBlockProperty::GetList(array("sort"=>"asc", "name"=>"asc"), array("ACTIVE"=>"Y", "IBLOCK_ID"=>(isset($arCurrentValues["IBLOCK_ID"])?$arCurrentValues["IBLOCK_ID"]:$arCurrentValues["ID"])));
	while ($arr=$rsProp->Fetch()) {
		$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
		if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S"))) {
			$arProperty_LNS[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
		}
	}

	$params = array();

	$params["DATA_TYPE"] = Array(
		"PARENT" => "DATA_SOURCE",
		"NAME" => GetMessage("STAR_OWLCAROUSEL_DATA_TYPE"),
		"TYPE" => "LIST",
		"VALUES" => Array(
			"FOLDER" => GetMessage("STAR_OWLCAROUSEL_FOLDER"),
			"IBLOCK" => GetMessage("STAR_OWLCAROUSEL_IBLOCK"),
		),
		"DEFAULT" => "FOLDER",
		"REFRESH" => "Y",
	);

	if ($arCurrentValues["DATA_TYPE"] != "IBLOCK") {
		$params["FOLDER"] = array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("STAR_OWLCAROUSEL_FOLDER_PATH"),
			"TYPE" => "STRING",
			"MULTIPLE" => "N",
			"DEFAULT" => "/upload/",
			"REFRESH" => "N",
		);
	} else {
		$params["IBLOCK_TYPE"] = Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("STAR_OWLCAROUSEL_IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		);

		$params["IBLOCK_ID"] = Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("STAR_OWLCAROUSEL_IBLOCK_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		);

		$params["COUNT"] = array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("STAR_OWLCAROUSEL_IBLOCK_COUNT"),
			"TYPE" => "STRING",
			"MULTIPLE" => "N",
			"DEFAULT" => "5",
			"REFRESH" => "N",
		);

		$params["IMAGE"] = array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("STAR_OWLCAROUSEL_IBLOCK_IMAGE"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"DEFAULT" => "DETAIL",
			"VALUES" => array(
				"DETAIL" => GetMessage("STAR_OWLCAROUSEL_IBLOCK_IMAGE_DETAIL"),
				"PREVIEW" => GetMessage("STAR_OWLCAROUSEL_IBLOCK_IMAGE_PREVIEW"),
			),
			"ADDITIONAL_VALUES" => "N",
		);

		$params["PROPERTY_CODE"] = array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("STAR_OWLCAROUSEL_IBLOCK_PROPERTY"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"DEFAULT" => "LINK",
			"VALUES" => $arProperty_LNS,
			"ADDITIONAL_VALUES" => "N",
		);

		$params["SORT_BY1"] = Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("STAR_OWLCAROUSEL_SORT_BY1"),
			"TYPE" => "LIST",
			"DEFAULT" => "SORT",
			"VALUES" => $arSortFields,
		);

		$params["SORT_ORDER1"] = Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("STAR_OWLCAROUSEL_SORT_ORDER1"),
			"TYPE" => "LIST",
			"DEFAULT" => "DESC",
			"VALUES" => $arSorts,
		);
	}

	$params["JQUERY"] = Array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("STAR_OWLCAROUSEL_JQUERY"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => 'N',
	);

	


		$params["COUNT_SLIDES"] = array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("STAR_OWLCAROUSEL_BANNER_COUNT_SLIDES"),
			"TYPE" => "STRING",
			"MULTIPLE" => "N",
			"DEFAULT" => "3",
			"REFRESH" => "N",
		);

		$params["MARGIN"] = array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("STAR_OWLCAROUSEL_BANNER_MARGIN"),
			"TYPE" => "STRING",
			"MULTIPLE" => "N",
			"DEFAULT" => "20",
			"REFRESH" => "N",
		);
	


	$params["CONTROLS"] = Array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("STAR_OWLCAROUSEL_BANNER_CONTROLS"),
		"TYPE" => "LIST",
		"VALUES" => array(
			"true" => GetMessage("STAR_OWLCAROUSEL_YES"),
			"false" => GetMessage("STAR_OWLCAROUSEL_NO"),
		),
		"DEFAULT" => "true",
		"REFRESH" => "N",
	);

	$params["PAGER"] = Array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("STAR_OWLCAROUSEL_BANNER_PAGER"),
		"TYPE" => "LIST",
		"VALUES" => array(
			"true" => GetMessage("STAR_OWLCAROUSEL_YES"),
			"false" => GetMessage("STAR_OWLCAROUSEL_NO"),
		),
		"DEFAULT" => "true",
		"REFRESH" => "N",
	);

	$params["AUTO"] = Array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("STAR_OWLCAROUSEL_BANNER_AUTO"),
		"TYPE" => "LIST",
		"VALUES" => array(
			"false" => GetMessage("STAR_OWLCAROUSEL_NO"),
			"true" => GetMessage("STAR_OWLCAROUSEL_YES"),
		),
		"DEFAULT" => "false",
		"REFRESH" => "N",
	);

	$params["LOOP"] = Array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("STAR_OWLCAROUSEL_BANNER_LOOP"),
		"TYPE" => "LIST",
		"VALUES" => array(
			"false" => GetMessage("STAR_OWLCAROUSEL_NO"),
			"true" => GetMessage("STAR_OWLCAROUSEL_YES"),
		),
		"DEFAULT" => "true",
		"REFRESH" => "N",
	);

	if ($arCurrentValues["AUTO"] == "true") {
		$params["PAUSE"] = array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("STAR_OWLCAROUSEL_BANNER_PAUSE"),
			"TYPE" => "STRING",
			"MULTIPLE" => "N",
			"DEFAULT" => "5",
			"REFRESH" => "N",
		);
	}

	if ($arCurrentValues["DATA_TYPE"] == "IBLOCK") {
		$params["LINK"] = Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("STAR_OWLCAROUSEL_LINK"),
			"TYPE" => "LIST",
			"VALUES" => array(
				"N" => GetMessage("STAR_OWLCAROUSEL_NO"),
				"Y" => GetMessage("STAR_OWLCAROUSEL_YES"),
			),
			"DEFAULT" => "N",
			"REFRESH" => "N",
		);

		$params["NEW_WINDOW"] = Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("STAR_OWLCAROUSEL_BANNER_NEW_WINDOW"),
			"TYPE" => "LIST",
			"VALUES" => array(
				"N" => GetMessage("STAR_OWLCAROUSEL_NO"),
				"Y" => GetMessage("STAR_OWLCAROUSEL_YES"),
			),
			"DEFAULT" => "N",
			"REFRESH" => "N",
		);
	}

	$arComponentParameters = array(
		"GROUPS" => $groups,
		"PARAMETERS" => $params
	);

?>