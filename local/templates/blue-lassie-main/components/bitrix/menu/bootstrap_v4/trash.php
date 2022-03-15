<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

$this->setFrameMode(true);

if (empty($arResult["ALL_ITEMS"]))
	return;

CUtil::InitJSCore();

$menuBlockId = "catalog_menu_".$this->randString();
?>
<div class="container bx-<?=$arParams["MENU_THEME"]?>" id="<?=$menuBlockId?>">
	<nav class="header__nav navigation" id="cont_<?=$menuBlockId?>">
		<ul class="header__menu menu menu_width_full" id="ul_<?=$menuBlockId?>">
		<?    foreach($arResult["MENU_STRUCTURE"] as $itemID => $arColumns)
                        { ?>
                            <li class="menu__item">
                                <a href=""<?=$arResult["ALL_ITEMS"][$itemID]["LINK"]?>" class="menu__name"><?=htmlspecialcharsbx($arResult["ALL_ITEMS"][$itemID]["TEXT"], ENT_COMPAT, false)?></a>
                                
                               <? if (is_array($arColumns) && count($arColumns) > 0)
                                { ?>
								<ul class="dropdown-menu">
									<li class="dropdown-menu__content">
										<div class="dropdown-menu__img">
											<img src="assets/images/header-submenu-1.jpg" alt="девочка">
										</div>
										<div class="dropdown-menu__menu-col">
										<?
                                        foreach($arColumns as $key=>$arRow)
                                        {
                                        ?>
											<ul class="vertical-menu">
											<?foreach($arRow as $itemIdLevel_2=>$arLevel_3):?>
												<li class="vertical-menu__item"><span class="vertical-menu__name"><?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["TEXT"]?></span>
												<?if (is_array($arLevel_3) && count($arLevel_3) > 0):?>
													<ul class="vertical-menu__submenu">
                                                        <?foreach($arLevel_3 as $itemIdLevel_3):?>
														<li class="vertical-menu__submenu-item"><a href="<?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["LINK"]?>" class="link vertical-menu__submenu-name"><?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["TEXT"]?></a>
														</li>
													</ul>
												</li>
											</ul>
										<?endforeach;?>
										</div>
									</li>
								</ul>
							<?endif;?>
							</li>
            <?endforeach;?>
		</ul>
	</nav>
</div>                    
