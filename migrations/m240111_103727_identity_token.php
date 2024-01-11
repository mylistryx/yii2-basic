<?php

use app\enum\Table;
use yii\db\Migration;

/**
 * Class m240111_103727_identity_token
 */
class m240111_103727_identity_token extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(Table::IdentityToken->value, [
            'id' => $this->primaryKey(),
            'identity_id' => $this->integer()->notNull(),
            'value' => $this->string()->notNull()->unique(),
            'type' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'expires_at' => $this->dateTime()->null(),
        ]);

        $this->addForeignKey(
            'FK_IdentityToken_IdentityId__Identity_Id',
            Table::IdentityToken->value,
            ['identity_id'],
            Table::Identity->value,
            ['id'],
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(Table::IdentityToken->value);
    }
}
