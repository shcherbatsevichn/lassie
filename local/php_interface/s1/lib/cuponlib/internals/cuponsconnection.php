<?php
namespace Lib\Cuponlib\Internals;

use Bitrix\Main\Entity;

class CuponConnectionTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'my_cupone_connection';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            new Entity\StringField('CUPONE_ID', array(
                'required' => true,
                'column_name' => 'CUPONE_ID'
            )),
            new Entity\StringField('ORDER_ID', array(
                'required' => true,
                'column_name' => 'ORDER_ID'
            )),
            new Entity\BooleanField('USE', array(
                'values' => array('N', 'Y')
            ))
        );
    }
}

