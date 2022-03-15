<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];

require(realpath(dirname(__FILE__)).'/top_template.php');

dump($arResult);

if ($arParams["SHOW_PRODUCTS"] == "Y" && ($arResult['NUM_PRODUCTS'] > 0 || !empty($arResult['CATEGORIES']['DELAY'])))
{
?>

				<div class="bx-basket-item-list-item-status"><?=GetMessage("TSB1_$category")?></div>

					<div data-role="basket-item-list" class="bx-basket-item-list">
						<div id="<?=$cartId?>products" class="bx-basket-item-list-container">
						<div class="header__col header__col_basket"><span class="header__icon icon-bag"></span>
						<div class="header__basket">
							<div class="text">В вашей корзине</div><a href="<?= $arParams['PATH_TO_BASKET'] ?>" class="link"><?= $arResult['NUM_PRODUCTS'] ?> <?= $prods?> на <?= $arResult['TOTAL_PRICE_RAW'] ?> руб.</a>
						</div>
					</div>
		</div>
	</div>
		</div>
	</div>

	<script>
		BX.ready(function(){
			<?=$cartId?>.fixCart();
		});
	</script>
<?
}