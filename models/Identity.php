<?php

declare(strict_types=1);

namespace app\models;

use yii\base\BaseObject;
use yii\web\IdentityInterface;

class Identity extends BaseObject implements IdentityInterface
{
    public int|string $id = '';
    public string $username = '';
    public string $email = '';
    public string $passwordHash = '';
    public string $authKey = '';
    public string $accessToken = '';
    public string $created_at = '';
    public string $updated_at = '';
    private static array $_users = [
        '100' => [
            'id'           => '100',
            'username'     => 'admin',
            'email'        => 'admin@net23.ru',
            // password: admin
            'passwordHash' => '$2y$13$gYAywKSkhfZDq9FLNdm7buKnvlRxDexf5xipSMAxQPDUxpaptmZJu',
            'authKey'      => 'test100key',
            'accessToken'  => '100-token',
            'created_at'   => '2001-01-01 00:00:00',
            'updated_at'   => '2001-01-01 00:00:00',
        ],
        '101' => [
            'id'           => '101',
            'username'     => 'demo',
            'email'        => 'demo@net23.ru',
            // password: demo
            'passwordHash' => '$2y$13$alRLq1PGVMlGYwS/Y3iy3ewQns1Z8ol8Iq6Zb5k7ZwEhblA1aL29y',
            'authKey'      => 'test101key',
            'accessToken'  => '101-token',
            'created_at'   => '2002-01-01 00:00:00',
            'updated_at'   => '2002-01-01 00:00:00',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id): static|null
    {
        return isset(self::$_users[$id]) ? new static(self::$_users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null): static|null
    {
        foreach (self::$_users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public static function findByUsername(string $username): static|null
    {
        foreach (self::$_users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): int|string
    {
        return $this->id;
    }

    public function getAuthKey(): string
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->authKey === $authKey;
    }
}
