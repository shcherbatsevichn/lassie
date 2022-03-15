<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
if($arResult['NUM_PRODUCTS'] == 1){
	$prods = GetMessage('TSB1_1PROD');
}elseif($arResult['NUM_PRODUCTS'] > 1 && $arResult['NUM_PRODUCTS'] < 5){
	$prods = GetMessage('TSB1_2_4PROD');
}else{
	$prods = GetMessage('TSB1_MANYPROD');
}


?>
<div class="header__col header__col_basket"><span class="header__icon icon-bag"></span>
	<div class="header__basket">
		<div class="text">В вашей корзине</div><a href="<?= $arParams["PATH_TO_ORDER"] ?>" class="link"><?= $arResult['NUM_PRODUCTS'] ?> <?= $prods?> на <?= $arResult['TOTAL_PRICE_RAW'] ?> руб.</a>
	</div>
</div>




