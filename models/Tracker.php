<?php

namespace app\models;

use app\components\db\ActiveRecord;
use app\enums\Tables;
use yii\helpers\ArrayHelper;

/**
 * @var string $id
 * @var string $url
 * @var string|null $description
 * @var string|null $login
 * @var string|null $password
 */
class Tracker extends ActiveRecord
{
    public bool $useUuidInsteadInt = true;
    public string|false $createdAtAttribute = 'created_at';
    public string|false $updatedAtAttribute = 'updated_at';
    public string|false $createdByAttribute = 'created_by';
    public string|false $updatedByAttribute = 'updated_by';

    public static function tableName(): string
    {
        return Tables::Tracker->value;
    }

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), []);
    }

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), []);
    }

    public function relations(): array
    {
        return ArrayHelper::merge(parent::relations(), []);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), []);
    }
}
