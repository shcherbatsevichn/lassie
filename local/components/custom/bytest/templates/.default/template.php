<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?CUtil::InitJSCore( array('ajax' , 'popup' ));?>
<div>
    <a onclick="getPopUp();" href = "javascript:void(0);">Купить в 1 клик</a>
</div>

<?	
//dump($arParams["OFFERS"]);
	
	$jsParams = array(
		//"URL" => $arResult["DIR"], 
		'OFFERS' => $arParams["OFFERS"],
	);
?>



<script>
	//var myparams = new phpParams(<?//=json_encode($jsParams)?>);
	var offer = <?=CUtil::PhpToJSObject($jsParams)?>;
	/*BX.ready(function () {
	var myparams = new phpParams(<?//=CUtil::PhpToJSObject($jsParams)?>);
	});*/
</script>