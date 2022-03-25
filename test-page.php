<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Test-page");
?>
<? 
use Lib\Cuponlib\CuponConnectionTable;
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

dump($book->fetch());

//echo $book->getPublisher()->getTitle();

dump($cuponsArray);

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
