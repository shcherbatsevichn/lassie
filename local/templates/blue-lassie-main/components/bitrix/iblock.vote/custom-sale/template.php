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

CJSCore::Init(array("ajax"));

//Let's determine what value to display: rating or average ?
if ($arParams['DISPLAY_AS_RATING'] === 'vote_avg')
{
	if (
		!empty($arResult['PROPERTIES']['vote_count']['VALUE'])
		&& is_numeric($arResult['PROPERTIES']['vote_sum']['VALUE'])
		&& is_numeric($arResult['PROPERTIES']['vote_count']['VALUE'])
	)
	{
		$DISPLAY_VALUE = round($arResult['PROPERTIES']['vote_sum']['VALUE'] / $arResult['PROPERTIES']['vote_count']['VALUE'], 2);
	}
	else
	{
		$DISPLAY_VALUE = 0;
	}
}
else
{
	$DISPLAY_VALUE = $arResult["PROPERTIES"]["rating"]["VALUE"];
}
$voteContainerId = 'vote_'.$arResult["ID"];
?>
<div class="bx-rating text-primary" id="<?echo $voteContainerId?>">
	<div class="raiting">
	<?
	$onclick = "JCFlatVote.do_vote(this, '".$voteContainerId."', ".$arResult["AJAX_PARAMS"].")";
	foreach ($arResult["VOTE_NAMES"] as $i => $name)
	{
		

		$itemContainerId = $voteContainerId.'_'.$i;
		?><span
			class="raiting__star raiting__star_choose"
			id="<?echo $itemContainerId?>"
			title="<?echo $name?>"
			<?if (!$arResult["VOTED"] && $arParams["READ_ONLY"]!=="Y"):?>
				onmouseover="JCFlatVote.trace_vote(this, true);"
				onmouseout="JCFlatVote.trace_vote(this, false)"
				onclick="<?echo htmlspecialcharsbx($onclick);?>"
			<?endif;?>
		></span><?
	}
	if ($arParams["SHOW_RATING"] == "Y"):?>
		(<?echo $DISPLAY_VALUE?>)
	<?endif;
?>
	</div>
</div>