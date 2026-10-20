<?php

namespace app\components\traits;

use app\enums\Tables;
use app\models\Identity;
use app\models\IdentityToken;
use Yii;

/**
 * @see Identity
 *
 * @see self::setPassword()
 * @property-write string $password
 */
trait IdentityTrait
{
    public static function findIdentity($id): ?Identity
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): ?Identity
    {
        return IdentityToken::findOne(['token' => $token, 'type' => $type])?->identity;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    public function setPassword($password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
}
