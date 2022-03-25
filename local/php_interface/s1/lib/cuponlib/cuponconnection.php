<?php
namespace Lib\Cuponlib;

use Bitrix\Main\Entity;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;

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
            (new Reference(
                    'CUP',
                    CuponTable::class,
                    Join::on('this.CUPONE_ID', 'ref.ID')
                ))->configureJoinType('inner'),
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

