<?php
namespace Lib\Cuponlib;

use Lib\Cuponlib\Internals\CuponTable;
use Lib\Cuponlib\Internals\CuponConnectionTable;
use Bitrix\Main\SystemException;

class CuponCreater {

    static function createCupon($userID){
        $cuponParams = array(             //параметры для записи купона в таблицу
            'CUPONE_CODE' => self::generateCuponName(),
            'COMMENTS' => 'Этот купон выдаётся за заказ в 1 клик',
            'DISCOUNT_COUNT' => 500,
            'ID_OWNER' => intval($userID),
            'ACTIVE' => 'Y',
        );
        //делаем запись в таблиуцу купонов, получаем купона ID
        $result = CuponTable::add($cuponParams);  
        if($result->isSuccess()){
            $cuponID = $result->getId();
        }else{
            throw new SystemException("Произошла ошибка создания купона, попробуйте снова или обратитесь к администратору сайта");
        }
        //регистрируем его в таблице связей
        $registateParams = array(
            'CUPONE_ID' => $cuponID,
            'ORDER_ID' => 'null',
            'USE'=> 'N',
        );
        $result = CuponConnectionTable::add($registateParams);
        return true;
    }

    static function getCupon($userID){
        //получаем все купоны для пользователя
        $result = CuponTable::getList(array(
            'filter' => array('=ID_OWNER' => $userID)
        ));
        while ($row = $result->fetch())
        {
            $cuponsArray[] = $row;
        }
        if($cuponsArray == null){
            return false;
        }
        foreach($cuponsArray as $cupon){
            if($cupon['ACTIVE'] == 'Y'){
                $cuponResult['ID'] = $cupon['ID'];
                $cuponResult['DISCOUNT'] = $cupon['DISCOUNT_COUNT'];
                return $cuponResult;
            }
        }
        return false;
    }

    static function applyCupon($cuponID, $orderID){
        //обновляем таблицу связей
        $registateParams = array(
            'ORDER_ID' => $orderID,
            'USE'=> 'Y',
        );
        $result = CuponTable::getList(array(
            'filter' => array('=ID' => $cuponID)
        ));
        $conectionRow;
        while ($row = $result->fetch())
        {
            $conectionRow = $row;
        }
		//dump($conectionRow);
        $updateConnect = CuponConnectionTable::update($conectionRow['ID'],$registateParams);
        //обновляем таблицу с купонам 
        $cuponParams = array(
            'ACTIVE' => 'N',
        );
        $updateCupon = CuponTable::update($cuponID,$cuponParams);
    }

    private function generateCuponName(){
        $patern = '-0123456789-ABCDEFGHIJKLMNOPQRSTUVWXYZ-';
        $randomName = substr(str_shuffle($patern), 0, 16);
        return $randomName;
    }
}