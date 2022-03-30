<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Test-page");
?>
<? 
/*use Lib\Cuponlib\CuponConnectionTable;
use Lib\Cuponlib\CuponCreater;
use Bitrix\Sale\Order;
use Bitrix\Sale\Basket;
use \Bitrix\Sale\Fuser;
use \Bitrix\Main\Loader;

Loader::includeModule("sale");
Loader::includeModule("catalog");

$book = Lib\Cuponlib\CuponConnectionTable::getByPrimary(50, [
    'select' => ['*', 'CUPON_' => 'CUP']
]);

dump($book->fetch());*/

//echo $book->getPublisher()->getTitle();

//dump($cuponsArray);
?>
<?
$APPLICATION->IncludeComponent(
	"custom:easy.banner", 
	"text-left", array(
        "ID_IBLOCK" => 4,
    ));
if(CModule::IncludeModule("iblock"))
{
   /*$res = CIBlockElement::GetByID(394);
    if($obRes = $res->GetNextElement())
    {
    $ar_res = $obRes->GetProperties();
    //dump($ar_res);
    }*/
	$items = GetIBlockElementList(4, false, Array("SORT"=>"ASC"));
	while($arItem = $items->GetNext())
	{
        $result[] = $arItem;
	}
    foreach($result as $banner){
        $res = CIBlockElement::GetByID($banner['ID']);
        if($obRes = $res->GetNextElement())
        {
        $ar_res[] = $obRes->GetProperties();
        }
    }
    //dump($ar_res);

 
}

?>









<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>