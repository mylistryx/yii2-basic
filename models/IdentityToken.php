<?php
declare(strict_types=1);

namespace app\models;

use app\components\db\ActiveRecord;
use app\enums\Tables;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * @property string $id
 * @property string $identity_id
 * @property string $token
 * @property int $type
 * @property mixed $payload
 * @property string $created_at
 * @property string $updated_at
 *
 * @property-read Identity $identity
 */
class IdentityToken extends ActiveRecord
{
    public bool $useUuidInsteadInt = true;
    public string|false $createdAtAttribute = 'created_at';
    public string|false $updatedAtAttribute = 'updated_at';

    public static function tableName(): string
    {
        return Tables::IdentityToken->value;
    }

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), []);
    }

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), []);
    }

    public function getIdentity(): ActiveQuery
    {
        return $this->hasOne(Identity::class, ['id' => 'identity_id']);
    }
}
