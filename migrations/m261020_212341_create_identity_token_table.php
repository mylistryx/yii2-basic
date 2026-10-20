<?php

use app\components\migrations\Migration;
use app\enums\Tables;

class m261020_212341_create_identity_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(Tables::IdentityToken->value, [
            'id' => $this->uuidPK(),
            'identity_id' => $this->uuid()->notNull(),
            'token' => $this->string()->notNull()->unique(),
            'type' => $this->integer()->notNull(),
            'payload' => $this->json()->null(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        $this->createIndex('idxIdentityToken_IdentityId', Tables::IdentityToken->value, 'identity_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(Tables::IdentityToken->value);
    }
}
