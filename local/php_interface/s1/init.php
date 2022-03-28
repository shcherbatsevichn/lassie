<?php

if (file_exists($_SERVER['DOCUMENT_ROOT']."/local/php_interface/s1/include/debug.php")){
    require_once($_SERVER['DOCUMENT_ROOT']."/local/php_interface/s1/include/debug.php");
}
use \Bitrix\Main\Loader;

Loader::registerNamespace(
 "Lib\\Cuponlib",
  Loader::getDocumentRoot().'/local/php_interface/s1/lib/cuponlib/',
);
