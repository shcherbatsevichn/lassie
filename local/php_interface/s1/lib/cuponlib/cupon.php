<?php
namespace Lib\Cuponlib;

use Bitrix\Main\Entity;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;

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
                (new Reference(
                    'CUPONE_ID',
                    CuponConnectionTable::class,
                    Join::on('this.ID', 'ref.CUPONE_ID')
                ))
                ->configureJoinType('inner'),
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
