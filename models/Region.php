<?php

namespace app\models;

use app\components\db\ImmutableRecord;
use app\enums\Tables;

/**
 * @property string $id
 * @property string $name
 */
class Region extends ImmutableRecord
{
    public static function tableName(): string
    {
        return Tables::Region->value;
    }

    public static function find(): RegionQuery
    {
        return new RegionQuery(static::class);
    }

    public static function findById(string $id): static
    {
        return static::findOne($id);
    }

    public static function dropdownList(): array
    {
        return static::find()->select('name')->indexBy('id')->asArray()->all();
    }
}