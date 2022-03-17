<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<nav class="header__nav navigation">
<ul class="header__menu menu menu_width_full" style="z-index: 300;">
	

<?


$previousLevel = 0;
$countercollons = 0;
foreach($arResult as $arItem):?>
	<?$additionalclass ='';?>
	<?$contetn =$arItem["TEXT"];?>

	<?if ($previousLevel == 3 && $arItem["DEPTH_LEVEL"] == 1):?>
		</ul></ul></div></li></ul></li>
	<?elseif ($previousLevel == 3 && $arItem["DEPTH_LEVEL"] == 2):?>
		</ul></li>
	<?endif?>


	<?if ($arItem["DEPTH_LEVEL"] == 1):?>
		<?$countercollons = 0;?>
	<?elseif ($arItem["DEPTH_LEVEL"] == 2):?>
		<?$countercollons++;?>
	<?endif?>

	<?if ($countercollons == 5):?>
		</div>
		<div class="dropdown-menu__menu-col">
			<ul class="vertical-menu">
	<?endif?>

	<?if($arItem["TEXT"] == "Распродажа"):	
		$additionalclass = "header__sale-wrapper";
		$contetn = "<span class='header__sale'>".$arItem["TEXT"]."</span>";
	?>
	<?else:
        $contetn = $arItem["TEXT"];
	?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="menu__item"><a href="<?=$arItem["LINK"]?>" class="menu__name <?=$additionalclass?>"><?=$contetn?></a>
				<ul class="dropdown-menu" style="padding: 0">
					<li class="dropdown-menu__content">
					<div class="dropdown-menu__img">
						<img src="<?=$arItem["PARAMS"]["picture_src"]?>" class="logo__img"  width="576" height="384" alt="девочка">
					</div>
					<div class="dropdown-menu__menu-col">
						<ul class="vertical-menu">
		<?endif?>

		<?if ($arItem["DEPTH_LEVEL"] == 2 ):?>

			<li class="vertical-menu__item"><span class="vertical-menu__name"><?=$arItem["TEXT"]?></span>
				<ul class="vertical-menu__submenu">
		<?endif?>



	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="menu__item"><a href="<?=$arItem["LINK"]?>" class="menu__name <?=$additionalclass?>"><?=$contetn?></a></li>
			<?endif?>

			<?if ($arItem["DEPTH_LEVEL"] == 2):?>
				<li class="vertical-menu__item"><a href="<?=$arItem["LINK"]?>" class="vertical-menu__name" ><?=$arItem["TEXT"]?></a></li>
			<?endif?>

			<?if ($arItem["DEPTH_LEVEL"] == 3):?>
				<li class="vertical-menu__submenu-item"><a href="<?=$arItem["LINK"]?>" class="link vertical-menu__submenu-name" ><?=$arItem["TEXT"]?></a></li>
			<?endif?>


		<?endif?>

	<?endif?>

	

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>


</ul>
<button class="burger-btn header__nav-btn js-nav-btn"><span class="burger-btn__switch">Развернуть меню </span>
</button>
	<div class="navigation__collapse">
		<ul class="navigation__collapse-menu vertical-menu">
			<?
            $arCollapsMenu = array_reverse($arResult);
			
			foreach($arCollapsMenu as $arItem):?>
				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<li class="navigation__collapse-item vertical-menu__item"><a href="<?=$arItem["LINK"]?>" class="vertical-menu__name"><?=$arItem["TEXT"]?></a>
								</li>
				<?endif?>
			<?endforeach?>	
		</ul>
	</div>



</nav>

<?endif?>
