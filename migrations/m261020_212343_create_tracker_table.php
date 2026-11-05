<?php

use app\components\migrations\Migration;
use app\enums\Tables;

class m261020_212343_create_tracker_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(Tables::Tracker->value, [
            'id'          => $this->uuidPK(),
            'identity_id' => $this->uuid()->notNull(),
            'name'        => $this->string()->notNull()->unique(),
            'url'         => $this->string()->notNull()->unique(),
            'description' => $this->integer()->notNull(),
            'created_at'  => $this->dateTime()->notNull(),
            'updated_at'  => $this->dateTime()->notNull(),
        ]);

        $this->createIndex('idxIdentityToken_IdentityId', Tables::Tracker->value, 'identity_id');

        $this->addFK(Tables::Tracker, Tables::Identity, 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(Tables::IdentityToken->value);
    }
}
