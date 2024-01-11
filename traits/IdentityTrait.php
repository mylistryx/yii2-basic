<?php

namespace app\traits;

use Yii;
use yii\base\Exception;

trait IdentityTrait
{
    /**
     * @throws Exception
     */
    public function setPassword(string $password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public static function findIdentity($id): ?static
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null): ?static
    {
        return static::findOne(['identity_token' => $token]);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword(?string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
}