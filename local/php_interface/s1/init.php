<?php

if (file_exists($_SERVER['DOCUMENT_ROOT']."/local/php_interface/s1/include/debug.php")){
    require_once($_SERVER['DOCUMENT_ROOT']."/local/php_interface/s1/include/debug.php");
}
use \Bitrix\Main\Loader;
/*Loader::registerAutoLoadClasses(
    null,
    array(
        "Lib\Cuponlib\CuponCreater" => "/local/php_interface/s1/lib/cuponlib/cuponcreater.php",
        "Lib\Cuponlib\Internals\CuponTable" => "/local/php_interface/s1/lib/cuponlib/internals/cupons.php",
        "Lib\Cuponlib\Internals\CuponConnectionTable" => "/local/php_interface/s1/lib/cuponlib/internals/cuponsconnection.php"
    ),
   );*/
Loader::registerNamespace(
 "Lib\\Cuponlib",
  Loader::getDocumentRoot().'/local/php_interface/s1/lib/cuponlib/',
);
/*Loader::registerNamespace(
 "Lib\Cuponlib\Internals",
  Loader::getDocumentRoot()."/local/php_interface/s1/lib/cuponlib/internals/",
);*/
