<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);


?>


<!DOCTYPE html>
<html lang="ru">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="imagetoolbar" content="no">
		<meta name="msthemecompatible" content="no">
		<meta name="cleartype" content="on">
		<meta name="HandheldFriendly" content="True">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="address=no">
		<meta name="google" value="notranslate">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<meta name="application-name" content="">
		<meta name="msapplication-tooltip" content="">
		<title><?$APPLICATION->ShowTitle()?></title>
        <? $APPLICATION->ShowHead(); ?>
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&amp;subset=latin,cyrillic" rel="stylesheet">
		<link href="<?=SITE_TEMPLATE_PATH?>/assets/styles/app.min.css" rel="stylesheet">
	</head>

	<body>
	<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
		<header class="header">
			<div class="header__top">
				<div class="container header__container header__container_top">
					<div class="header__col header__col_top-left"><span class="header__icon icon-mail"></span><a href="javascript:void(0);" class="link">Подписаться</a>
					</div>
					<div class="header__col header__col_top-right">
						<ul class="header__top-menu menu" style="margin-bottom: 0px;">

							<li class="menu__item"><a href="<?=SITE_DIR."lassie/about-company-lassie/"?>" class="link menu__name">О компании</a>
							</li>
							<li class="menu__item"><a href="<?=SITE_DIR."purchases/order-payment-methods/"?>" class="link menu__name">Оплата</a>
							</li>
							<li class="menu__item"><a href="<?=SITE_DIR."purchases/delivery/"?>" class="link menu__name">Доставка</a>
							</li>
						</ul>
						<?$APPLICATION->IncludeComponent(
							"bitrix:search.title", 
							"bootstrap_v4", 
							array(
								"NUM_CATEGORIES" => "1",
								"TOP_COUNT" => "5",
								"CHECK_DATES" => "N",
								"SHOW_OTHERS" => "N",
								"PAGE" => SITE_DIR."catalog/",
								"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
								"CATEGORY_0" => array(
									0 => "iblock_catalog",
								),
								"CATEGORY_0_iblock_catalog" => array(
									0 => "all",
								),
								"CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
								"SHOW_INPUT" => "Y",
								"INPUT_ID" => "title-search-input",
								"CONTAINER_ID" => "search",
								"PRICE_CODE" => array(
									0 => "BASE",
								),
								"SHOW_PREVIEW" => "Y",
								"PREVIEW_WIDTH" => "75",
								"PREVIEW_HEIGHT" => "75",
								"CONVERT_CURRENCY" => "Y",
								"COMPONENT_TEMPLATE" => "bootstrap_v4",
								"ORDER" => "date",
								"USE_LANGUAGE_GUESS" => "Y",
								"TEMPLATE_THEME" => "blue",
								"PRICE_VAT_INCLUDE" => "Y",
								"PREVIEW_TRUNCATE_LEN" => "",
								"CURRENCY_ID" => "RUB"
							),
							false
						);?>
					</div>
				</div>
			</div>
			<div class="header__middle">
				<div class="container header__container header__container_middle">
					<div class="header__col header__col_logo">
						<a href="<?=SITE_DIR?>" class="header__logo logo">  <!-- logo -->
                            <?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/company_logo.php"),
							false
						);?>
						</a>
					</div>
					<div class="header__contacts"><span class="header__icon icon-comment"></span>
						<div class="header__col header__col_contacts">
							<div class="contacts"><a href="tel:+74952150435" class="contacts__tel">8 495 215-04-35</a>
								<div class="contacts__info">с 9:00 до 24:00 ежедневно</div>
							</div>
						</div>
						<div class="header__col header__col_contacts">
							<div class="contacts"><a href="tel:+78003331204" class="contacts__tel">8 800 333-12-04</a>
								<div class="contacts__info">24 часа 7 дней в неделю</div>
							</div>
						</div>
						<div class="header__col header__col_contacts"><a href="<?=SITE_DIR."purchases/kontakts/"?>" class="link"><?=GetMessage('CONTACT_INFO')?></a>
						</div>
					</div>
					<div class="header__col header__col_basket">    <!-- малая корзина --> 
						<?$APPLICATION->IncludeComponent(                   
							"custom:sale.basket.basket.line", 
							"def", 
							array(
								"HIDE_ON_BASKET_PAGES" => "N",
								"PATH_TO_AUTHORIZE" => "",
								"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
								"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
								"PATH_TO_PERSONAL" => SITE_DIR."personal/",
								"PATH_TO_PROFILE" => SITE_DIR."personal/",
								"PATH_TO_REGISTER" => SITE_DIR."login/",
								"POSITION_FIXED" => "N",
								"SHOW_AUTHOR" => "N",
								"SHOW_EMPTY_VALUES" => "Y",
								"SHOW_NUM_PRODUCTS" => "Y",
								"SHOW_PERSONAL_LINK" => "Y",
								"SHOW_PRODUCTS" => "N",
								"SHOW_REGISTRATION" => "N",
								"SHOW_TOTAL_PRICE" => "Y",
								"COMPONENT_TEMPLATE" => "def"
							),
							false
						);?>
					</div>
				</div>
			</div>
			<div class="header__bottom">  <!-- отображаем вертикальное меню --> 
				<div class="container">
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu", 
						"horizontal_csutom", 
						array(
							"ROOT_MENU_TYPE" => "left",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_THEME" => "site",
							"CACHE_SELECTED_ITEMS" => "N",
							"MENU_CACHE_GET_VARS" => array(
							),
							"MAX_LEVEL" => "3",
							"CHILD_MENU_TYPE" => "left",
							"USE_EXT" => "Y",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N",
							"COMPONENT_TEMPLATE" => "horizontal_csutom"
						),
						false
					);?>
				</div>
			</div>
		</header>
		<?if($APPLICATION->GetCurPage() == '/'):?> <!-- отображаем карусель --> 
			<?$APPLICATION->IncludeComponent(
				"custom:owlcarousel", 
				"custom-template", 
				array(
					"COMPONENT_TEMPLATE" => "custom-template",
					"JQUERY" => "N",
					"COUNT_SLIDES" => "1",
					"MARGIN" => "20",
					"CONTROLS" => "true",
					"PAGER" => "true",
					"AUTO" => "false",
					"LOOP" => "true",
					"DATA_TYPE" => "FOLDER",
					"FOLDER" => "/upload/images/",
					"LINK" => "Y",
					"NEW_WINDOW" => "N",
					"IBLOCK_TYPE" => "news",
					"IBLOCK_ID" => "1",
					"COUNT" => "5",
					"IMAGE" => "DETAIL",
					"PROPERTY_CODE" => "",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "DESC"
				),
				false
			);?>		
		<?endif;?>
		<main class="content catalog-page">
			<?if($APPLICATION->GetCurPage() != '/'):?>
				<?$APPLICATION->IncludeComponent(
				"bitrix:breadcrumb", 
				"universal", 
				array(
					"COMPONENT_TEMPLATE" => "universal",
					"PATH" => "",
					"SITE_ID" => "s1",
					"START_FROM" => "0"
				),
				false
			);?>
			<?endif;?>
			
			<?if($APPLICATION->GetCurPage() == '/'):?> <!-- Для главной страницы -->
				<div class="container">
					<h1 class="heading"><span class="heading__text"><?$APPLICATION->ShowTitle(false);?></span></h1>
			<?elseif(preg_match('/\/catalog\/[a-z0-9_-]+\/[a-z,0-9].+/',$APPLICATION->GetCurPage())):?>	 <!-- Для страницы детального просмотра товара убираем title-->
				<div class="container">
			<?else:?>
				<div class="container"> <!-- Для всех остальных страниц --> 
					<h1 class="title"><?$APPLICATION->ShowTitle(false);?></h1>
			<?endif;?>
		
  
		
				
