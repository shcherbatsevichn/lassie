<?php
namespace Lib\Cuponlib\Internals;

use Bitrix\Main\Entity;

class CuponTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'my_cupone';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            new Entity\StringField('CUPONE_CODE', array(
                'required' => true,
                'column_name' => 'CUPONE_CODE'
            )),
            new Entity\StringField('COMMENTS'),
			new Entity\IntegerField('DISCOUNT_COUNT'),
			new Entity\IntegerField('ID_OWNER'),
			new Entity\BooleanField('ACTIVE', array(
                'values' => array('N', 'Y')
            ))
        );
    }
}
