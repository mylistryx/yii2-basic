<?php

declare(strict_types=1);

namespace app\models;

use app\components\db\ActiveRecord;
use app\enums\Tables;
use yii\helpers\ArrayHelper;

/**
 * @property string $id
 * @property string $identity_id
 * @property string $route
 * @property int $code
 * @property string $referer
 * @property string $created_at
 *
 * @property-read Identity[]|array $identityTokens
 */
class ActionLog extends ActiveRecord
{
    public bool $useUuidInsteadInt = true;
    public string|false $createdAtAttribute = 'created_at';

    public static function tableName(): string
    {
        return Tables::Identity->value;
    }

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), []);
    }

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), []);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), []);
    }
}
