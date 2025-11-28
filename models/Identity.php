<?php

namespace app\models;

use app\behaviors\UuidBehavior;
use app\components\db\Record;
use app\enums\IdentityStatus;
use app\enums\Tables;
use app\traits\IdentityInterfaceTrait;
use Yii;
use yii\base\Exception;
use yii\web\IdentityInterface;

/**
 * @property string $id
 * @property string $email
 * @property int $current_status
 * @property string $auth_key
 * @property string $password_hash
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 ***** Magic *****
 * @see self::getStatus()
 * @see self::setStatus()
 * @property IdentityStatus $status
 *
 * @see self::setPassword()
 * @property-write string $password
 ***** Relations *****
 * @see self::getIdentityTokens()
 * @property-read IdentityToken[]|array $identityTokens
 */
class Identity extends Record implements IdentityInterface
{
    use IdentityInterfaceTrait;

    public static function tableName(): string
    {
        return Tables::Identity->value;
    }

    public function behaviors(): array
    {
        return array_merge(parent::behaviors(), [
            'Uuid' => [
                'class' => UuidBehavior::class,
            ],
        ]);
    }

    public function rules(): array
    {
        return [
            ['auth_key','required'],
            ['auth_key', 'string', 'max' => 32],
            ['current_status', 'required'],
            ['current_status', 'in', 'range' => IdentityStatus::values()],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique'],
        ];
    }

    public static function find(): IdentityQuery
    {
        return new IdentityQuery(static::class);
    }

    public function getStatus(): IdentityStatus
    {
        return IdentityStatus::tryFrom($this->current_status);
    }

    public function setStatus(IdentityStatus $status): void
    {
        $this->current_status = $status->value;
    }

    /**
     * @throws Exception
     */
    public function setPassword(string $password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /** Relations */

    public function getIdentityTokens(?int $type = null): array
    {
        $query = $this->hasMany(IdentityTokenQuery::class, ['identity_id' => $this->id]);
        if ($type !== null) {
            $query->andWhere(['type' => $type]);
        }
        return $query->all();
    }
}
