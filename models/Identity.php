<?php

namespace app\models;

use app\enum\Table;
use app\traits\IdentityTrait;
use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
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
 * @property-read array|IdentityToken[] $identityTokens
 */
class Identity extends ActiveRecord implements IdentityInterface
{
    use IdentityTrait;

    public static function tableName(): string
    {
        return Table::Identity->value;
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

    /**
     * @throws Exception
     */
    public function rules(): array
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique'],
            ['auth_key', 'default', 'value' => Yii::$app->security->generateRandomString()],
        ];
    }

    public function getIdentityTokens(): ActiveQuery
    {
        return $this->hasMany(IdentityToken::class, ['id' => 'identity_id']);
    }

    /**
     * @throws Exception
     */
    public static function create(string $email, ?string $password): static
    {
        $identity = new static([
            'email' => $email,
            'password' => $password ?? Yii::$app->security->generateRandomString(Yii::$app->params['identity.passwordMinLength']),
        ]);
        $identity->save();

        return $identity;
    }

    public static function findByEmail(string $email): ?static
    {
        return static::findOne(['email' => $email]);
    }
}
