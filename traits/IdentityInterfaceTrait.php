<?php

namespace app\traits;

use app\components\db\Record;
use app\enums\IdentityStatus;
use app\models\Identity;
use app\models\IdentityToken;
use yii\db\ActiveRecord;

trait IdentityInterfaceTrait
{
    public static function findIdentity($id): null|Identity|Record|ActiveRecord
    {
        return Identity::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): null|Identity|Record|ActiveRecord
    {
        $identityToken = IdentityToken::findOne(['token_value' => $token, 'token_type' => $type]);
        return $identityToken?->identity;
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
        return $this->auth_key === $authKey;
    }
}