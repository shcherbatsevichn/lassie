<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

	if(!CModule::IncludeModule("iblock") || !isset($arParams["IBLOCK_ID"])) return;

	$arResult["JQUERY"] = $arParams["JQUERY"];
	$arResult["COUNT_SLIDES"] = intval($arParams["COUNT_SLIDES"]);
	$arResult["MARGIN"] = intval($arParams["MARGIN"]);
	$arResult["CONTROLS"] = $arParams["CONTROLS"];
	$arResult["PAGER"] = $arParams["PAGER"];
	$arResult["AUTO"] = $arParams["AUTO"];
	$arResult["PAUSE"] = intval($arParams["PAUSE"]);
	$arResult["LOOP"] = $arParams["LOOP"]; // TODO: add to settings?
	if ($arParams["CAPTIONS"] == "true") $arResult["CAPTIONS"] = $arParams["CAPTIONS"];
	else $arResult["CAPTIONS"] = "false";
	if ($arParams["NEW_WINDOW"] == "N") $arResult["NEW_WINDOW"] = "";
	else $arResult["NEW_WINDOW"] = " target=\"_blank\"";

	// Select elements from iblock
	$arResult["ITEMS"] = array();
	if ($arParams["DATA_TYPE"] == "FOLDER") {
		foreach (glob($_SERVER["DOCUMENT_ROOT"]."/".SITE_DIR.$arParams["FOLDER"]."/*.{jpg,jpeg,png}", GLOB_NOESCAPE | GLOB_BRACE) as $file) {
			if (!is_dir($file)) {
				$arResult["ITEMS"][] = array("PICTURE" => str_replace($_SERVER["DOCUMENT_ROOT"]."/".SITE_DIR, "", $file));
			}
		}
	} else {
		$arOrder = Array($arParams["SORT_BY1"] => $arParams["SORT_ORDER1"]);
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_".$arParams["PROPERTY_CODE"]);
		$arFilter = Array("IBLOCK_ID" => intval($arParams["IBLOCK_ID"]), "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList($arOrder, $arFilter, false, Array ("nTopCount" => intval($arParams["COUNT"])), $arSelect);
		while($ob = $res->GetNextElement()) {
			$item = $ob->GetFields();

			$img = CFile::GetFileArray($item[$arParams["IMAGE"]."_PICTURE"]);
			if (is_array($img) && isset($img["SRC"])) {
				$item["PICTURE"] = $img["SRC"];

				if (!empty($item["PROPERTY_".strtoupper($arParams["PROPERTY_CODE"])."_VALUE"]))
					$item["LINK"] = $item["PROPERTY_".strtoupper($arParams["PROPERTY_CODE"])."_VALUE"];

				$arResult["ITEMS"][] = $item;
			}
		}
	}

	$this->IncludeComponentTemplate();
?>