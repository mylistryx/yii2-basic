<?php

use app\components\migrations\Migration;
use app\enums\IdentityStatus;
use app\enums\Tables;

class m251128_101937_create_identity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(Tables::Identity->value, [
            'id' => $this->uuidPk(),
            'email' => $this->string()->notNull(),
            'current_status' => $this->integer()->notNull(),
            'auth_key' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        $this->createIndex('IDX_Identity_email', Tables::Identity->value, 'email');
        $this->createIndex('IDX_Identity_current_status', Tables::Identity->value, 'current_status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropIndex('IDX_Identity_current_status', Tables::Identity->value);
        $this->dropIndex('IDX_Identity_email', Tables::Identity->value);
        $this->dropTable(Tables::Identity->value);
    }
}
