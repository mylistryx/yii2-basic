<?php

declare(strict_types=1);

namespace app\models;

use app\components\db\ActiveRecord;
use app\components\traits\IdentityTrait;
use app\enums\Tables;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * @property string $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $created_at
 * @property string $updated_at
 *
 * @property-read Identity[]|array $identityTokens
 */
class Identity extends ActiveRecord implements IdentityInterface
{
    use IdentityTrait;

    public bool $useUuidInsteadInt = true;
    public string|false $createdAtAttribute = 'created_at';
    public string|false $updatedAtAttribute = 'updated_at';


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

    public function getIdentityTokens(): ActiveQuery
    {
        return $this->hasMany(IdentityToken::class, ['identity_id' => 'id']);
    }

}
