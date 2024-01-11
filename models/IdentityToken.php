<?php

namespace app\models;

use app\enum\IdentityTokenType;
use app\enum\Table;
use DateTimeImmutable;
use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $identity_id
 * @property string $token
 * @property int $type
 * @property string $created_at
 * @property string $updated_at
 * @property string $expires_at
 * @property-read Identity $identity
 * @property-read bool $isExpired
 */
class IdentityToken extends ActiveRecord
{
    public static function tableName(): string
    {
        return Table::IdentityToken->value;
    }

    public function behaviors(): array
    {
        return [
            'TimeStamp' => [
                'class' => TimestampBehavior::class,
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }

    public function rules(): array
    {
        return [
            [['identity_id', 'token', 'type'], 'required'],
            ['type', 'in', 'range' => IdentityTokenType::values()],
            ['expires_at', 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            ['token', 'unique'],
            ['identity_id', 'exist', 'targetClass' => Identity::class, 'targetAttribute' => 'id'],
        ];
    }

    public function getIdentity(): ActiveQuery
    {
        return $this->hasOne(Identity::class, ['id' => 'identity_id']);
    }

    /**
     * @throws Exception
     */
    public static function create(
        Identity $identity,
        IdentityTokenType $type,
        ?string $token = null,
        ?DateTimeImmutable $expires = null
    ): static {
        $token = new static([
            'identity_id' => $identity->id,
            'token' => $token ?? Yii::$app->security->generateRandomString(),
            'type' => $type->value,
            'expires_at' => $expires->format('Y-m-d H:i:s') ?? null,
        ]);
        $token->save();
        return $token;
    }

    public static function findByToken(string $token, IdentityTokenType $type): array|ActiveRecord|static
    {
        return static::find()
            ->where(['token' => $token, 'type' => $type->value])
            ->orderBy(['updated_at' => SORT_DESC])
            ->one();
    }
}