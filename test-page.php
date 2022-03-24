<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Test-page");
?>
<? 
use Lib\Cuponlib\Internals\CuponConnectionTable;
use Lib\Cuponlib\CuponCreater;
use Bitrix\Sale\Order;
use Bitrix\Sale\Basket;
use \Bitrix\Sale\Fuser;
use \Bitrix\Main\Loader;

Loader::includeModule("sale");
Loader::includeModule("catalog");

$order = Order::create(SITE_ID, 1, 'RUB');

dump($r);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>