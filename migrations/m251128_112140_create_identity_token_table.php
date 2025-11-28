<?php

use app\components\migrations\Migration;
use app\enums\Tables;

class m251128_112140_create_identity_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(Tables::IdentityToken->value, [
            'id' => $this->primaryKey(),
            'identity_id' => $this->uuid()->notNull(),
            'token_value' => $this->string()->notNull()->unique(),
            'token_type' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
        ]);

        $this->addForeignKey(
            'FK_IdentityToken_identity_id__Identity_id',
            Tables::IdentityToken->value,
            'identity_id',
            Tables::Identity->value,
            'id',
            'CASCADE');

        $this->createIndex('IDX_IdentityToken__token_value__token_type', Tables::IdentityToken->value, ['token_value', 'token_type']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropIndex('IDX_IdentityToken__token_value__token_type', Tables::IdentityToken->value);
        $this->dropForeignKey('FK_IdentityToken_identity_id__Identity_id', Tables::IdentityToken->value);
        $this->dropTable(Tables::IdentityToken->value);
    }
}
