<?php

use app\components\migrations\Migration;
use app\enums\Tables;

class m261020_212340_create_identity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(Tables::Identity->value, [
            'id' => $this->uuidPK(),
            'username' => $this->string(64)->notNull()->unique(),
            'email' => $this->string(64)->notNull()->unique(),
            'password_hash' => $this->string(64)->notNull(),
            'auth_key' => $this->string(64)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(Tables::Identity->value);
    }
}
