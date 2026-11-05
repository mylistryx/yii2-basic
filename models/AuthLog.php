<?php

declare(strict_types=1);

namespace app\models;

use app\components\db\ActiveRecord;
use app\enums\Tables;
use app\exceptions\AuthFailtureException;
use Exception;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * @property string $id
 * @property string $email
 * @property boolean $success
 * @property string $ip
 * @property string $created_at
 *
 * @property-read Identity[]|array $identityTokens
 */
class AuthLog extends ActiveRecord
{
    public bool $useUuidInsteadInt = true;
    public string|false $createdAtAttribute = 'created_at';

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
        return ArrayHelper::merge(parent::rules(), [
            ['email' => 'string'],
            ['ip' => 'string'],
            ['success' => 'boolean'],
        ]);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), []);
    }

    public static function logSuccess(string $email): void
    {
        self::logAuthAttempt($email, true);
    }

    public static function logFailure(string $email, AuthFailtureException $exception): void
    {
        self::logAuthAttempt($email, false);
    }

    private static function logAuthAttempt(string $email, bool $success): void
    {
        try {
            new self([
                'email'   => $email,
                'success' => $success,
                'ip'      => Yii::$app->getRequest()->getUserIP(),
            ])->save();
        } catch (Exception) {
        }
    }
}
