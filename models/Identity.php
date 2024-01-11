<?php

namespace app\models;

use app\traits\IdentityTrait;
use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int $id
 * @property string $email
 * @property string $password_hash
 * @property string $identity_token
 * @property string $password_reset_token
 * @property string $confirmation_token
 * @property string $auth_key
 * @property-write string $password
 */
class Identity extends ActiveRecord implements IdentityInterface
{
    use IdentityTrait;

    /**
     * @throws Exception
     */
    public function setPassword(string $password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
}
