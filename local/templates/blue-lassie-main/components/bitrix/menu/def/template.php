<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<ul class="header__menu menu menu_width_full">
<?
//dump($arResult[7], true);
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["PARAMS"]["DEPTH_LEVEL"] == 1):?>	
			<li class="menu__item"><a href="<?=$arItem["LINK"]?>" class="menu__name"><?=$arItem["TEXT"]?></a>
			<?if($arItem["IS_PARENT"] == true):?>

			<?endif?>
	<?endif?>
	
<?endforeach?>

</ul>
<?endif?>