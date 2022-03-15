<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */

?>



<article class="good">
	<div class="good__content">
	<? if ($itemHasDetailUrl): ?>
	<a class="product-item-image-wrapper" href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$imgTitle?>"
		data-entity="image-wrapper">
		<? else: ?>
		<span class="product-item-image-wrapper" data-entity="image-wrapper">
	<? endif; ?>
		<span class="product-item-image-slider-slide-container slide" id="<?=$itemIds['PICT_SLIDER']?>"
			<?=($showSlider ? '' : 'style="display: none;"')?>
			data-slider-interval="<?=$arParams['SLIDER_INTERVAL']?>" data-slider-wrap="true">
			<?
			if ($showSlider)
			{
				foreach ($morePhoto as $key => $photo)
				{
					?>
					<span class="product-item-image-slide item <?=($key == 0 ? 'active' : '')?>" style="background-image: url('<?=$photo['SRC']?>');"></span>
					<?
				}
			}
			?>
		</span>
		<span class="product-item-image-original" id="<?=$itemIds['PICT']?>" style="background-image: url('<?=$item['PREVIEW_PICTURE']['SRC']?>'); <?=($showSlider ? 'display: none;' : '')?>"></span>
		
		<?
		if ($item['SECOND_PICT'])
		{
			$bgImage = !empty($item['PREVIEW_PICTURE_SECOND']) ? $item['PREVIEW_PICTURE_SECOND']['SRC'] : $item['PREVIEW_PICTURE']['SRC'];
			?>
			<span class="product-item-image-alternative" id="<?=$itemIds['SECOND_PICT']?>" style="background-image: url('<?=$bgImage?>'); <?=($showSlider ? 'display: none;' : '')?>"></span>
			<?
		}

		if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y')
		{
			?>
			<div class="product-item-label-ring <?=$discountPositionClass?>" id="<?=$itemIds['DSC_PERC']?>"
				<?=($price['PERCENT'] > 0 ? '' : 'style="display: none;"')?>>
				<span><?=-$price['PERCENT']?>%</span>
			</div>
			<?
		}

		if ($item['LABEL'])
		{
			?>
			<div class=" <?=$labelPositionClass?>" id="<?=$itemIds['STICKER_ID']?>" style=" position: absolute; z-index: 15;">
				<?
				if (!empty($item['LABEL_ARRAY_VALUE']))
				{			
					foreach ($item['LABEL_ARRAY_VALUE'] as $code => $value)
					{
						switch($value){
							case "New":
								$additionalClass = "flag_type_new";
								break;
							case "Hit":
								$additionalClass = "flag_type_hit";
								break;
							case "Sale":
								$additionalClass = "flag_type_sale";
								break;
							}
						?>
						<div <?=(!isset($item['LABEL_PROP_MOBILE'][$code]) ? ' class="d-none d-sm-block"' : '')?>>
							<span class="flag <?=$additionalClass?>" title="<?=$value?>"><?=$value?></span>
						</div>
						<?
					}
				}
				?>
			</div>
			<?
		}
		?>
		<div href="#" class="like" value="Мне нравится"></div>
		<span class="product-item-image-slider-control-container" id="<?=$itemIds['PICT_SLIDER']?>_indicator"
			<?=($showSlider ? '' : 'style="display: none;"')?>>
			<?
			if ($showSlider)
			{
				foreach ($morePhoto as $key => $photo)
				{
					?>
					<span class="product-item-image-slider-control<?=($key == 0 ? ' active' : '')?>" data-go-to="<?=$key?>"></span>
					<?
				}
			}
			?>
		</span>
		<?
		if ($arParams['SLIDER_PROGRESS'] === 'Y')
		{
			?>
			<span class="product-item-image-slider-progress-bar-container">
				<span class="product-item-image-slider-progress-bar" id="<?=$itemIds['PICT_SLIDER']?>_progress_bar" style="width: 0;"></span>
			</span>
			<?
		}
		?>
			<? if ($itemHasDetailUrl): ?>
		</a>
			<? else: ?>
		</span>
		<? endif; ?>
		<h4 class="good__name" style="font-weight: 300;">
			<?=$productTitle?>
	</h4>
	
	<?
	if (!empty($arParams['PRODUCT_BLOCKS_ORDER']))
	{
		foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName)
		{
			switch ($blockName)
			{
				case 'price': //цена?>
					<div class="good__price-wrapper" data-entity="price-block">
						<?
						if ($arParams['SHOW_OLD_PRICE'] === 'Y')
						{
							?>
							<?if($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE']){
									
									$additioanlclass = '';
									$additioanlstyle = 'style="display: none;"';
								}else{
									$additioanlclass = 'good__price_new';
									$additioanlstyle = '';
								} ?>
							<span class="good__price <?=$additioanlclass?>" id="<?=$itemIds['PRICE']?>">
							<?
							if (!empty($price))
							{
								if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers)
								{
									echo Loc::getMessage(
										'CT_BCI_TPL_MESS_PRICE_SIMPLE_MODE',
										array(
											'#PRICE#' => $price['PRINT_RATIO_PRICE'],
											'#VALUE#' => $measureRatio,
											'#UNIT#' => $minOffer['ITEM_MEASURE']['TITLE']
										)
									);
								}
								else
								{
									echo $price['PRINT_RATIO_PRICE'];
								}
							}
							?>
							</span>
							<span class="good__price good__price_old" id="<?=$itemIds['PRICE_OLD']?>"
								<?=$additioanlstyle?>>
								<?=$price['PRINT_RATIO_BASE_PRICE']?>
							</span>&nbsp;
							<?
							if($additioanlclass != ""){
								?>
								<span class="good__discount">Скидка <?=$price['PERCENT']?>%</span>
								<?
							}
						}
						?>
						
					</div>
					</div>	
					
					<div class="good__hover">
					<?
					break;


				case 'quantityLimit':
					if ($arParams['SHOW_MAX_QUANTITY'] !== 'N')
					{
						if ($haveOffers)
						{
							if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
							{
								?>
								<div class="product-item-info-container product-item-hidden"
									id="<?=$itemIds['QUANTITY_LIMIT']?>"
									style="display: none;"
									data-entity="quantity-limit-block">
									<div class="good__order-label">
										<?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
										<span class="product-item-quantity text-dark" data-entity="quantity-limit-value"></span>
									</div>
								</div>
								<?
							}
						}
						else
						{
							if (
								$measureRatio
								&& (float)$actualItem['CATALOG_QUANTITY'] > 0
								&& $actualItem['CATALOG_QUANTITY_TRACE'] === 'Y'
								&& $actualItem['CATALOG_CAN_BUY_ZERO'] === 'N'
							)
							{
								?>
								<div class="product-item-info-container product-item-hidden" id="<?=$itemIds['QUANTITY_LIMIT']?>">
									<div class="product-item-info-container-title text-muted">
										<?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
										<span class="product-item-quantity text-dark" data-entity="quantity-limit-value">
												<?
												if ($arParams['SHOW_MAX_QUANTITY'] === 'M')
												{
													if ((float)$actualItem['CATALOG_QUANTITY'] / $measureRatio >= $arParams['RELATIVE_QUANTITY_FACTOR'])
													{
														echo $arParams['MESS_RELATIVE_QUANTITY_MANY'];
													}
													else
													{
														echo $arParams['MESS_RELATIVE_QUANTITY_FEW'];
													}
												}
												else
												{
													echo $actualItem['CATALOG_QUANTITY'].' '.$actualItem['ITEM_MEASURE']['TITLE'];
												}
												?>
											</span>
									</div>
								</div>
								<?
							}
						}
					}

					break;

				case 'quantity': // выбор количества
					if (!$haveOffers)
					{
						if ($actualItem['CAN_BUY'] && $arParams['USE_PRODUCT_QUANTITY'])
						{
							?>
							<div class="product-item-info-container product-item-hidden" data-entity="quantity-block">
								<div class="good__order-row">
										<label for="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>" class="good__order-label">Количество</label>
										<div class="input-number">
											<input step="1" min="1" required class="input-number__elem" id="<?=$itemIds['QUANTITY']?>" type="number" name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>" value="<?=$measureRatio?>">
											<div class="input-number__counter"><span class="input-number__counter-spin input-number__counter-spin_more" id="<?=$itemIds['QUANTITY_UP']?>">Больше</span><span id="<?=$itemIds['QUANTITY_DOWN']?>" class="input-number__counter-spin input-number__counter-spin_less">Меньше</span>
												</div>
										</div>
								</div>
							</div>
							<?
						}
					}
					elseif ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
					{
						if ($arParams['USE_PRODUCT_QUANTITY'])
						{
							?>
							<div class="product-item-info-container product-item-hidden" data-entity="quantity-block">
								<div class="good__order-row">
										<label for="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>" class="good__order-label">Количество</label>
										<div class="input-number">
											<input step="1" min="1" required class="input-number__elem" id="<?=$itemIds['QUANTITY']?>" type="number" name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>" value="<?=$measureRatio?>">
											<div class="input-number__counter"><span class="input-number__counter-spin input-number__counter-spin_more" id="<?=$itemIds['QUANTITY_UP']?>">Больше</span><span id="<?=$itemIds['QUANTITY_DOWN']?>" class="input-number__counter-spin input-number__counter-spin_less">Меньше</span>
												</div>
										</div>
								</div>
							</div>
							<?
						}
					}

					break;

				case 'buttons': //кнопка
					?>
					<div class="product-item-info-container product-item-hidden" data-entity="buttons-block">
						<?
						if (!$haveOffers)
						{
							if ($actualItem['CAN_BUY'])
							{
								?>
								<div  id="<?=$itemIds['BASKET_ACTIONS']?>">
									<button class="btn " id="<?=$itemIds['BUY_LINK']?>" style="border-radius: 0px; color: white; padding-top: 0px; padding-bottom: 0px;"
											href="javascript:void(0)" rel="nofollow">
										<?=($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?>
									</button>
								</div>
								<?
							}
							else
							{
								?>
								<div class="">
									<?
									if ($showSubscribe)
									{
										$APPLICATION->IncludeComponent(
											'bitrix:catalog.product.subscribe',
											'',
											array(
												'PRODUCT_ID' => $actualItem['ID'],
												'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
												'BUTTON_CLASS' => 'btn btn-primary '.$buttonSizeClass,
												'DEFAULT_DISPLAY' => true,
												'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
											),
											$component,
											array('HIDE_ICONS' => 'Y')
										);
									}
									?>
									<button class="btn"
											id="<?=$itemIds['NOT_AVAILABLE_MESS']?>" style="border-radius: 0px; color: white; padding-top: 0px; padding-bottom: 0px;" href="javascript:void(0)" rel="nofollow">
										<?=$arParams['MESS_NOT_AVAILABLE']?>
									</button>
								</div>
								<?
							}
						}
						else
						{
							if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
							{
								?>
								<div class="">
									<?
									if ($showSubscribe)
									{
										$APPLICATION->IncludeComponent(
											'bitrix:catalog.product.subscribe',
											'',
											array(
												'PRODUCT_ID' => $item['ID'],
												'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
												'BUTTON_CLASS' => 'btn btn-primary '.$buttonSizeClass,
												'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
												'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
											),
											$component,
											array('HIDE_ICONS' => 'Y')
										);
									}
									?>
									<button class="btn" style="border-radius: 0px; color: white; padding-top: 0px; padding-bottom: 0px;"
											id="<?=$itemIds['NOT_AVAILABLE_MESS']?>" href="javascript:void(0)" rel="nofollow"
										<?=($actualItem['CAN_BUY'] ? 'style="display: none;"' : '')?>>
										<?=$arParams['MESS_NOT_AVAILABLE']?>
									</button>
									<div id="<?=$itemIds['BASKET_ACTIONS']?>" <?=($actualItem['CAN_BUY'] ? '' : 'style="display: none;"')?>>
										<button class="btn" style="border-radius: 0px; color: white; padding-top: 0px; padding-bottom: 0px;" id="<?=$itemIds['BUY_LINK']?>"
												href="javascript:void(0)" rel="nofollow">
											<?=($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?>
										</button>
									</div>
								</div>
								<?
							}
						
						}
						?>
					</div>
					<?
					break;

				case 'props':
					if (!$haveOffers)
					{
						if (!empty($item['DISPLAY_PROPERTIES']))
						{
							
							
									foreach ($item['DISPLAY_PROPERTIES'] as $code => $displayProperty)
									{
										?>
										<span class="flag flag_type_new"><?=$displayProperty['NAME']?></span>
										<dt class="text-muted <?=(!isset($item['PROPERTY_CODE_MOBILE'][$code]) ? ' d-none d-sm-block' : '' )?> ">
											<?=$displayProperty['NAME']?>
										</dt>
										<dd class="text-dark<?=(!isset($item['PROPERTY_CODE_MOBILE'][$code]) ? ' d-none d-sm-block' : '')?>">
											<?=(is_array($displayProperty['DISPLAY_VALUE'])
												? implode(' / ', $displayProperty['DISPLAY_VALUE'])
												: $displayProperty['DISPLAY_VALUE'])?>
										</dd>
										<?
									}
									?>
						
							<?
						}

						if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !empty($item['PRODUCT_PROPERTIES']))
						{
							?>
							<div id="<?=$itemIds['BASKET_PROP_DIV']?>" style="display: none;">
								<?
								if (!empty($item['PRODUCT_PROPERTIES_FILL']))
								{
									foreach ($item['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
									{
										?>
										<input type="hidden" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propID?>]"
											value="<?=htmlspecialcharsbx($propInfo['ID'])?>">
										<?
										unset($item['PRODUCT_PROPERTIES'][$propID]);
									}
								}

								if (!empty($item['PRODUCT_PROPERTIES']))
								{
									?>
									<table>
										<?
										foreach ($item['PRODUCT_PROPERTIES'] as $propID => $propInfo)
										{
											?>
											<tr>
												<td><?=$item['PROPERTIES'][$propID]['NAME']?></td>
												<td>
													<?
													if (
														$item['PROPERTIES'][$propID]['PROPERTY_TYPE'] === 'L'
														&& $item['PROPERTIES'][$propID]['LIST_TYPE'] === 'C'
													)
													{
														foreach ($propInfo['VALUES'] as $valueID => $value)
														{
															?>
															<label>
																<? $checked = $valueID === $propInfo['SELECTED'] ? 'checked' : ''; ?>
																<input type="radio" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propID?>]"
																	value="<?=$valueID?>" <?=$checked?>>
																<?=$value?>
															</label>
															<br />
															<?
														}
													}
													else
													{
														?>
														<select name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propID?>]">
															<?
															foreach ($propInfo['VALUES'] as $valueID => $value)
															{
																$selected = $valueID === $propInfo['SELECTED'] ? 'selected' : '';
																?>
																<option value="<?=$valueID?>" <?=$selected?>>
																	<?=$value?>
																</option>
																<?
															}
															?>
														</select>
														<?
													}
													?>
												</td>
											</tr>
											<?
										}
										?>
									</table>
									<?
								}
								?>
							</div>
							<?
						}
					}
					else
					{
						$showProductProps = !empty($item['DISPLAY_PROPERTIES']);
						$showOfferProps = $arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $item['OFFERS_PROPS_DISPLAY'];

						if ($showProductProps || $showOfferProps)
						{
							?>
							<div class="product-item-info-container product-item-hidden" data-entity="props-block">
								<dl class="product-item-properties">
									<?
									if ($showProductProps)
									{
										foreach ($item['DISPLAY_PROPERTIES'] as $code => $displayProperty)
										{
											?>
											<dt class="text-muted <?=(!isset($item['PROPERTY_CODE_MOBILE'][$code]) ? ' flag flag_type_new' : '')?>">
												<?=$displayProperty['NAME']?>
											</dt>
											<dd class="text-dark <?=(!isset($item['PROPERTY_CODE_MOBILE'][$code]) ? ' flag flag_type_new' : '')?>">
												<?=(is_array($displayProperty['DISPLAY_VALUE'])
													? implode(' / ', $displayProperty['DISPLAY_VALUE'])
													: $displayProperty['DISPLAY_VALUE'])?>
											</dd>
											<?
										}
									}

									if ($showOfferProps)
									{
										?>
										<span id="<?=$itemIds['DISPLAY_PROP_DIV']?>" style="display: none;"></span>
										<?
									}
									?>
								</dl>
							</div>
							<?
						}
					}

					break;

				case 'sku': //размеры
					if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $haveOffers && !empty($item['OFFERS_PROP']))
					{ 
						?>
						
						
						<div class="product-item-info-container product-item-hidden" id="<?=$itemIds['PROP_DIV']?>">
							<?
							foreach ($arParams['SKU_PROPS'] as $skuProperty)
							{	
								//dump($skuProperty);
					
								if($skuProperty["CODE"] != "color_new"){
																
									$propertyId = $skuProperty['ID'];
								$skuProperty['NAME'] = htmlspecialcharsbx($skuProperty['NAME']);
								if (!isset($item['SKU_TREE_VALUES'][$propertyId]))
									continue;
								?>
								<div data-entity="sku-block">
									<div class="product-item-scu-container" data-entity="sku-line-block">
										<div class="good__order-label"><?=$skuProperty['NAME']?></div>
										
												<div class="good__order-row">
													<ul class="product-item-scu-item-list">
													<?
													foreach ($skuProperty['VALUES'] as $value)
													{
													
														if (!isset($item['SKU_TREE_VALUES'][$propertyId][$value['ID']]))
															continue;

														$value['NAME'] = htmlspecialcharsbx($value['NAME']);
														if ($skuProperty['SHOW_MODE'] === 'PICT')
														{
															?>
															<li class="product-item-scu-item-color-container" title="<?=$value['NAME']?>" data-treevalue="<?=$propertyId?>_<?=$value['ID']?>" data-onevalue="<?=$value['ID']?>">
																<div class="product-item-scu-item-color-block">
																	<div class="product-item-scu-item-color" title="<?=$value['NAME']?>" style="background-image: url('<?=$value['PICT']['SRC']?>');"></div>
																</div>
															</li>
															<?
														}
														else
														{
															
															?>
														<li class="product-item-scu-item-text-container" style="padding:0; min-width: 20px;" title="<?=$value['NAME']?>"
																data-treevalue="<?=$propertyId?>_<?=$value['ID']?>" data-onevalue="<?=$value['ID']?>">
																<div class="product-item-scu-item-text-block">
																	<div class="product-item-scu-item-text"><?=$value['NAME']?></div>
																</div>
															</li>
															<?
														}
													}
													?>
													</ul>
													</div>									
									
									</div>
								</div>
								<?
								}
							}
							?>
						</div>
						<?
						foreach ($arParams['SKU_PROPS'] as $skuProperty)
						{
							if (!isset($item['OFFERS_PROP'][$skuProperty['CODE']]))
								continue;

							$skuProps[] = array(
								'ID' => $skuProperty['ID'],
								'SHOW_MODE' => $skuProperty['SHOW_MODE'],
								'VALUES' => $skuProperty['VALUES'],
								'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
							);
						}

						unset($skuProperty, $value);

						if ($item['OFFERS_PROPS_DISPLAY'])
						{
							foreach ($item['JS_OFFERS'] as $keyOffer => $jsOffer)
							{
								$strProps = '';

								if (!empty($jsOffer['DISPLAY_PROPERTIES']))
								{
									foreach ($jsOffer['DISPLAY_PROPERTIES'] as $displayProperty)
									{
										$strProps .= '<dt>'.$displayProperty['NAME'].'</dt><dd>'
											.(is_array($displayProperty['VALUE'])
												? implode(' / ', $displayProperty['VALUE'])
												: $displayProperty['VALUE'])
											.'</dd>';
									}
								}

								$item['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
							}
							unset($jsOffer, $strProps);
						}
					}

					break;
			}
		}
	}

	if (
		$arParams['DISPLAY_COMPARE']
		&& (!$haveOffers || $arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
	)
	{
		?>
		<div class="product-item-compare-container">
			<div class="product-item-compare">
				<div class="checkbox">
					<label id="<?=$itemIds['COMPARE_LINK']?>">
						<input type="checkbox" data-entity="compare-checkbox">
						<span data-entity="compare-title"><?=$arParams['MESS_BTN_COMPARE']?></span>
					</label>
				</div>
			</div>
		</div>
		<?
	}
	?>
	</div>
</article>	
