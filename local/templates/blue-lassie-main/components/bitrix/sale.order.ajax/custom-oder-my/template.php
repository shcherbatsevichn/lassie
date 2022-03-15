<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 * @var CUser $USER
 * @var SaleOrderAjax $component
 * @var string $templateFolder
 */

$context = Main\Application::getInstance()->getContext();
$request = $context->getRequest();

$scheme = $request->isHttps() ? 'https' : 'http';

switch (LANGUAGE_ID)
{
	case 'ru':
		$locale = 'ru-RU'; break;
	case 'ua':
		$locale = 'ru-UA'; break;
	case 'tk':
		$locale = 'tr-TR'; break;
	default:
		$locale = 'en-US'; break;
}
//dump($arResult);
/*$this->addExternalJs($templateFolder.'/order_ajax.js');
\Bitrix\Sale\PropertyValueCollection::initJs();
$this->addExternalJs($templateFolder.'/script.js');*/
?>
	<NOSCRIPT>
		<div style="color:red"><?=Loc::getMessage('SOA_NO_JS')?></div>
	</NOSCRIPT>
<?

if ($request->get('ORDER_ID') <> '')
{
	include(Main\Application::getDocumentRoot().$templateFolder.'/confirm.php');
}
elseif ($arParams['DISABLE_BASKET_REDIRECT'] === 'Y' && $arResult['SHOW_EMPTY_BASKET'])
{
	include(Main\Application::getDocumentRoot().$templateFolder.'/empty.php');
}
else
{
	Main\UI\Extension::load('phone_auth');

	$themeClass = !empty($arParams['TEMPLATE_THEME']) ? ' bx-'.$arParams['TEMPLATE_THEME'] : '';
	$hideDelivery = empty($arResult['DELIVERY']);

	//dump($arResult); //["DELIVERY"]["ORDER_PROP"]
	?>
	<form class="form js-form-validate order-page__form" action="<?=$_SERVER['DOCUMENT ROOT']."/bitrix/components/bitrix/sale.order.ajax/ajax.php"?>" method="POST" name="ORDER_FORM"  id="bx-soa-order-form" enctype="multipart/form-data" style="margin-top:15px;">

					<fieldset class="form__fieldset">
						<legend class="form__title" style="float: none;">Информация о покупателе</legend>
							<!-- ============================Персональные данные============================================ -->
						<?foreach($arResult["JS_DATA"]["ORDER_PROP"]["properties"] as $userProps):?>
							<?
								switch($userProps["CODE"]){
									case "FIO":
										?>
											<div class="form__row">
												<div class="form__col form__col_width_220">
													<label for="order-name" class="form__label"><?=$userProps["NAME"]?></label>
												</div>
												<div class="form__col form__col_width_375">
													<input name="ORDER_PROP_<?=$userProps["ID"]?>" id="soa-property-<?=$userProps["ID"]?>" required class="input" type="text">
												</div>
											</div>
										<?
										break;
										case "EMAIL":
											?>
												<div class="form__row">
													<div class="form__col form__col_width_220">
														<label for="order-mail" class="form__label"><?=$userProps["NAME"]?></label>
													</div>
													<div class="form__col form__col_width_260">
														<input name="ORDER_PROP_<?=$userProps["ID"]?>" id="soa-property-<?=$userProps["ID"]?>" autocomplete="email" type="email" required class="input">
													</div>
													<div class="form__col">
														<div class="form__info">Мы не рассылаем спам и не передаем информацию третьим лицам</div>
													</div>
												</div>
											<?
											break;
										case "PHONE":
											?>
												<div class="form__row">
													<div class="form__col form__col_width_220">
														<label for="order-phone" class="form__label"><?=$userProps["NAME"]?></label>
													</div>
													<div class="form__col form__col_width_260">
														<input name="ORDER_PROP_<?=$userProps["ID"]?>" id="soa-property-<?=$userProps["ID"]?>" autocomplete="tel" type="tel" required class="input">
														<div class="form__info">Например, 9051234567</div>
													</div>
													<div class="form__col">
														<div class="form__info">Необходим для подтверждения заказа</div>
													</div>
												</div>
											<?
											break;

								}
										if ($userProps["CODE" ] == "city" || $userProps["CODE"] == "street" || $userProps["CODE"] == "post-code"){
											?>
												<div class="form__row">
													<div class="form__col form__col_width_220">
														<label for="ORDER_PROP_<?=$userProps["ID"]?>" class="form__label"><?=$userProps["NAME"]?></label>
													</div>
													<div class="form__col form__col_width_260">
														<input name="ORDER_PROP_<?=$userProps["ID"]?>" id="soa-property-<?=$userProps["ID"]?>" required class="input" type="text">
													</div>
												</div>
											<?
										}	
										if ($userProps["CODE" ] == "house-number" || $userProps["CODE"] == "building-part" || $userProps["CODE"] == "room"){
											?>
												<div class="form__row">
													<div class="form__col form__col_width_220">
														<label for="ORDER_PROP_<?=$userProps["ID"]?>" class="form__label"><?=$userProps["NAME"]?></label>
													</div>
													<div class="form__col form__col_width_90">
														<input name="ORDER_PROP_<?=$userProps["ID"]?>" id="soa-property-<?=$userProps["ID"]?>" required class="input" type="text">
													</div>
												</div>
											<?
										}															
							?>
						<?endforeach;?>
					</fieldset>
					<fieldset class="form__fieldset">
						<!-- ===========================================Доставка==================================================== -->
						<legend class="form__title" style="float: none;">Способ доставки</legend>
						<div class="form__row form__row_direction_column">
							<label class="form__label">Курьерская доставка</label>
							<div class="form__info">от 3 до 10 рабочих дней с момента отправки посылки</div>
							<div class="form__checkbox-group">
								<div class="checkbox">
									<input id="ID_DELIVERY_ID_5" name="DELIVERY_ID" type="checkbox" value="5" required  class="checkbox__elem">
									<label for="ID_DELIVERY_ID_5" class="checkbox__label form__label"><?=$arResult["JS_DATA"]["DELIVERY"][5]["NAME"]?></label>
								</div>
								<div class="form__label"><?=$arResult["JS_DATA"]["DELIVERY"][5]["PRICE"]?> руб.</div>
							</div>
							<div class="form__checkbox-group">
								<div class="checkbox">
									<input id="ID_DELIVERY_ID_6" name="DELIVERY_ID" type="checkbox" value="6"  required class="checkbox__elem">
									<label for="ID_DELIVERY_ID_6" class="checkbox__label form__label"><?=$arResult["JS_DATA"]["DELIVERY"][6]["NAME"]?></label>
								</div>
								<div class="form__label" value="<?=$arResult["JS_DATA"]["DELIVERY"][6]["PRICE"]?>"><?=$arResult["JS_DATA"]["DELIVERY"][6]["PRICE"]?> руб.</div>
							</div>
						</div>
						<div class="form__row form__row_direction_column">
							<label class="form__label">Почтовое отправление</label>
							<div class="form__checkbox-group">
								<div class="checkbox">
									<input id="ID_DELIVERY_ID_7" name="DELIVERY_ID" type="checkbox" value="7" required class="checkbox__elem">
									<label for="ID_DELIVERY_ID_7" class="checkbox__label form__label"><?=$arResult["JS_DATA"]["DELIVERY"][7]["NAME"]?></label>
								</div>
								<div class="form__label"><?=$arResult["JS_DATA"]["DELIVERY"][7]["PRICE"]?> руб.</div>
							</div>
						</div>
					</fieldset>
					
						<fieldset class="form__fieldset" ><!-- Оплата -->
							<legend class="form__title" style="float: none;">Способ оплаты</legend>
							<?foreach($arResult["JS_DATA"]["PAY_SYSTEM"] as $pay):?>
							<div class="radio">
								<input id="ID_PAY_SYSTEM_ID_<?=$pay['ID']?>" name="PAY_SYSTEM_ID" type="radio" value="<?=$pay['ID']?>" class="radio__elem">
								<label for="ID_PAY_SYSTEM_ID_<?=$pay['ID']?>" class="form__label radio__label"><?=$pay["NAME"]?></label>
							</div>
							<?endforeach?>
						</fieldset>
					
					<fieldset class="form__fieldset">
						<!-- шапка таблицы с товарами-->
						<legend class="form__title" style="float: none;">Состав заказа</legend>
						<div class="goods-table">
							<div class="goods-table__header">
								<div class="goods-table__header-row">
									<div class="goods-table__heading">Товары</div>
									<div class="goods-table__heading">Скидка</div>
									<div class="goods-table__heading">Цена</div>
									<div class="goods-table__heading">Количество</div>
									<div class="goods-table__heading">Сумма</div>
								</div>
							</div>
							<!--блок товаров в корзине-->
							<div class="goods-table__main">
							<?foreach($arResult["JS_DATA"]["GRID"]["ROWS"] as $row):?>  
								<div class="goods-table__row">
									<div class="goods-table__cell">
										<div class="goods-table__col">
											<div class="goods-table__img-wrapper">
												<img src="<?=$row["data"]["PREVIEW_PICTURE_SRC"]?>" alt="" class="goods-table__img">
											</div>
										</div>
										<div class="goods-table__col">
											<div class="goods-table__text"><?=$row["data"]["NAME"]?></div>
											<?foreach($row["data"]["PROPS"] as $props):?>
												<div class="goods-table__info"><?=$props["NAME"]?>: <?=$props['VALUE']?></div>
											<?endforeach?>
										</div>
									</div>
									<?
									$additionalClass = "";
									$persentplaseholder = '';
									if($row["data"]["DISCOUNT_PRICE_PERCENT"] != 0){
										$additionalClass ="goods-table__text_discount";
										$persentplaseholder = $row["data"]["DISCOUNT_PRICE_PERCENT"].' %';
									}
									
									?>
									<div class="goods-table__cell">
										<div class="goods-table__text goods-table__text_discount"><?=$persentplaseholder?></div>
									</div>
									<div class="goods-table__cell">
										<div class="goods-table__text"><?=$row["data"]["BASE_PRICE_FORMATED"]?></div>
									</div>
									<div class="goods-table__cell">
										<div class="goods-table__text"><?=$row["data"]["QUANTITY"]?> шт.</div>
									</div>
									<div class="goods-table__cell">
										<div class="goods-table__text <?=$additionalClass?>"><?=$row["data"]["PRICE_FORMATED"]?></div>
									</div>
								</div>
							<?endforeach?>	
							</div>
						</div>
					</fieldset>
					<div class="form__total">
						<div class="form__col-right">
							<div class="form__total-row form__total-row_goods-cost"><span class="form__total-item">Товаров на сумму:</span><span class="form__total-item"><?=$arResult["JS_DATA"]["TOTAL"]["ORDER_PRICE_FORMATED"]?></span>
							</div>
							<div class="form__total-row form__total-row_tax"><span class="form__total-item">В том числе НДС:</span><span class="form__total-item"><?=$arResult["JS_DATA"]["TOTAL"]["TAX_LIST"][0]["VALUE_MONEY_FORMATED"]?></span>
							</div>
							<div class="form__total-row form__total-row_general"><span class="form__total-item">Итого</span>
								<div class="form__total-item form__total-item_sum"><?=$arResult["JS_DATA"]["TOTAL"]["ORDER_TOTAL_PRICE_FORMATED"]?></div>
							</div>
							<p>Заполнение вышеуказанных данных является необходимым для оформления Заказа и осуществления доставки. Все данные находятся на территории РФ, согласно Законодательству РФ.</p>
							<p>Предоставляя свои персональные данные при оформлении Заказа, подтверждаю свое согласие на обработку моих персональных данных, а также на аудиозапись своего общения с представителями Сайта в период оформления Заказа и исполнения обязательств согласно
								<a
								href="javascript:void(0);" class="link">Пользовательскому Соглашению.</a>
							</p>
						</div>
					</div>
					<!--	ORDER SAVE BLOCK	-->
					
					<button type="submit" class="btn form__btn form__btn_align_right">Оформить заказ</button>
				

				</form>
				<?
	$signer = new Main\Security\Sign\Signer;
	$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.order.ajax');
	$messages = Loc::loadLanguageFile(__FILE__);
	?>
	<script>
		BX.message(<?=CUtil::PhpToJSObject($messages)?>);
		BX.Sale.OrderAjaxComponent.init({
			result: <?=CUtil::PhpToJSObject($arResult['JS_DATA'])?>,
			locations: <?=CUtil::PhpToJSObject($arResult['LOCATIONS'])?>,
			params: <?=CUtil::PhpToJSObject($arParams)?>,
			signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
			siteID: '<?=CUtil::JSEscape($component->getSiteId())?>',
			ajaxUrl: '<?=CUtil::JSEscape($component->getPath().'/ajax.php')?>',
			templateFolder: '<?=CUtil::JSEscape($templateFolder)?>',
			propertyValidation: true,
			showWarnings: true,
			pickUpMap: {
				defaultMapPosition: {
					lat: 55.76,
					lon: 37.64,
					zoom: 7
				},
				secureGeoLocation: false,
				geoLocationMaxTime: 5000,
				minToShowNearestBlock: 3,
				nearestPickUpsToShow: 3
			},
			propertyMap: {
				defaultMapPosition: {
					lat: 55.76,
					lon: 37.64,
					zoom: 7
				}
			},
			orderBlockId: 'bx-soa-order',
			authBlockId: 'bx-soa-auth',
			basketBlockId: 'bx-soa-basket',
			regionBlockId: 'bx-soa-region',
			paySystemBlockId: 'bx-soa-paysystem',
			deliveryBlockId: 'bx-soa-delivery',
			pickUpBlockId: 'bx-soa-pickup',
			propsBlockId: 'bx-soa-properties',
			totalBlockId: 'bx-soa-total'
		});
	</script>
	<script>
		<?
		// spike: for children of cities we place this prompt
		$city = \Bitrix\Sale\Location\TypeTable::getList(array('filter' => array('=CODE' => 'CITY'), 'select' => array('ID')))->fetch();
		?>
		BX.saleOrderAjax.init(<?=CUtil::PhpToJSObject(array(
			'source' => $component->getPath().'/get.php',
			'cityTypeId' => intval($city['ID']),
			'messages' => array(
				'otherLocation' => '--- '.Loc::getMessage('SOA_OTHER_LOCATION'),
				'moreInfoLocation' => '--- '.Loc::getMessage('SOA_NOT_SELECTED_ALT'), // spike: for children of cities we place this prompt
				'notFoundPrompt' => '<div class="-bx-popup-special-prompt">'.Loc::getMessage('SOA_LOCATION_NOT_FOUND').'.<br />'.Loc::getMessage('SOA_LOCATION_NOT_FOUND_PROMPT', array(
						'#ANCHOR#' => '<a href="javascript:void(0)" class="-bx-popup-set-mode-add-loc">',
						'#ANCHOR_END#' => '</a>'
					)).'</div>'
			)
		))?>);
	</script>
	<?
	
}