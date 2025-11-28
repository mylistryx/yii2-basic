<?php

namespace app\models;

use app\components\db\Record;
use app\enums\IdentityTokenType;
use app\enums\Tables;
use Yii;
use yii\db\ActiveQuery;
use yii\db\Exception;

/**
 * @property int $id
 * @property string $identity_id
 * @property string $token_value
 * @property int $token_type
 * @property string $created_at
 ******************************
 * @see self::getIdentity()
 * @see self::setIdentity()
 * @property null|Record|ActiveQuery|Identity $identity
 *
 * @see self::getValue()
 * @see self::setValue()
 * @property null|string $value
 *
 * @see self::getType()
 * @see self::setType()
 * @property null|IdentityTokenType $type
 */
class IdentityToken extends Record
{
    public static function tableName(): string
    {
        return Tables::IdentityToken->value;
    }

    public static function find(): IdentityTokenQuery
    {
        return new IdentityTokenQuery(static::class);
    }

    /** Relations */
    public function getIdentity(): ActiveQuery
    {
        return $this->hasOne(Identity::class, ['id' => 'identity_id']);
    }

    /** Magic */
    public function setIdentity(Identity $identity): void
    {
        $this->identity_id = $identity->id;
    }

    public function setType(IdentityTokenType $type): void
    {
        $this->token_type = $type->value;
    }

    public function getType(): ?IdentityTokenType
    {
        return IdentityTokenType::tryFrom($this->token_type);
    }

    public function getValue(): ?string
    {
        return $this->token_value;
    }

    public function setValue(string $value): void
    {
        $this->token_value = $value;
    }
}