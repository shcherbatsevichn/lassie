<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$arResult["SOCSERV"] = array();

if (isset($arParams["FACEBOOK"]) && !empty($arParams["FACEBOOK"]))
	$arResult["SOCSERV"]["FACEBOOK"] = array(
		"LINK" => $arParams["FACEBOOK"],
		"CLASS" => "fb"
	);

if (isset($arParams["GOOGLE"]) && !empty($arParams["GOOGLE"]))
	$arResult["SOCSERV"]["GOOGLE"] = array(
		"LINK" => $arParams["GOOGLE"],
		"CLASS" => "gp"
	);

if (isset($arParams["TWITTER"]) && !empty($arParams["TWITTER"]))
	$arResult["SOCSERV"]["TWITTER"] = array(
		"LINK" => $arParams["TWITTER"],
		"CLASS" => "tw"
	);

if (isset($arParams["VKONTAKTE"]) && !empty($arParams["VKONTAKTE"]))
	$arResult["SOCSERV"]["VKONTAKTE"] = array(
		"LINK" => $arParams["VKONTAKTE"],
		"CLASS" => "vk"
	);

if (isset($arParams["INSTAGRAM"]) && !empty($arParams["INSTAGRAM"]))
	$arResult["SOCSERV"]["INSTAGRAM"] = array(
		"LINK" => $arParams["INSTAGRAM"],
		"CLASS" => "in"
	);

if (isset($arParams["ODNOCLASSIKI"]) && !empty($arParams["ODNOCLASSIKI"]))
	$arResult["SOCSERV"]["ODNOCLASSIKI"] = array(
		"LINK" => $arParams["ODNOCLASSIKI"],
		"CLASS" => "ok"
	);


$arResult["STYLE_MAP"] = array(
	"FACEBOOK"=>["a-class"=>"socials__name_fb", "span-class" =>"icon-facebook"],
	"GOOGLE"=>["a-class"=>"", "span-class" =>""],
	"TWITTER"=>["a-class"=>"socials__name_tw", "span-class" =>"icon-twitter-bird"],
	"VKONTAKTE"=>["a-class"=>"socials__name_vk", "span-class" =>"icon-vkontakte"],
	"INSTAGRAM"=>["a-class"=>"", "span-class" =>""],
	"ODNOCLASSIKI"=>["a-class"=>"socials__name_ok", "span-class" =>"icon-odnoklassniki"],
	);

$arSort = array();

foreach($arResult["SOCSERV"] as $key => $value){
	$arSort[$arParams[$key."_SORT"]] =  $key;
}

ksort($arSort);
$arResult["SORT"] = $arSort;

$this->IncludeComponentTemplate();
?>