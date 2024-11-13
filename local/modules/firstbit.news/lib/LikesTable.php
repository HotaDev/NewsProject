<?php

namespace FirstBit\News;

use Bitrix\Main\ORM;
use Bitrix\Main\ORM\Data\DataManager;

class LikesTable extends DataManager
{
    /**
     * Имя таблицы
     */
    public static function getTableName()
    {
        return 'likes';
    }

    /**
     * Описание таблицы
     */
    public static function getMap()
    {
        return [
            new ORM\Fields\IntegerField('id', [
                'primary'      => true,
                'autocomplete' => true,
            ]),
            new ORM\Fields\IntegerField('user_id', [
                'required' => true,
            ]),
            new ORM\Fields\IntegerField('item_id', [
                'required' => true,
            ]),
            new ORM\Fields\Relations\Reference(
                'IBLOCK_TABLE',
                '\Bitrix\Iblock\Element',
                ['=this.ELEMENT_ID' => 'ref.ID'],
                ['join_type' => 'LEFT']
            ),
        ];
    }
}