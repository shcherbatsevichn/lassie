<?php
namespace Lib\Cuponlib;

use Lib\Cuponlib\CuponTable;
use Lib\Cuponlib\CuponConnectionTable;
use Bitrix\Main\SystemException;

class CuponCreater {

    static function createCupon($userID){
        $cuponeName = self::generateCuponName();
        $cuponParams = array(             //параметры для записи купона в таблицу
            'CUPONE_CODE' => $cuponeName,
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
        
        return $cuponeName;
    }

    static function getCupon($userID, $orderID){
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
                
            }
        }
        if($cuponResult){
        $registateParams = array(
            'CUPONE_ID' => $cuponResult['ID'],
            'ORDER_ID' => $orderID,
            'USE'=> 'N',
        );
        $result = CuponConnectionTable::add($registateParams);
        $cuponResult['REG_ID'] = $result->getId();
        return $cuponResult;
        }
        return false;
    }

    static function applyCupon($cuponID, $orderID, $regID){
        //обновляем таблицу связей
        $registateParams = array(
            'CUPONE_ID' => $cuponID,
            'ORDER_ID' => $orderID,
            'USE'=> 'Y',
        );
        $updateConnect = CuponConnectionTable::update($regID,$registateParams);
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
