<?php

use app\components\migrations\Migration;
use app\enums\Tables;

class m261020_212342_create_action_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(Tables::ActionLog->value, [
            'id'          => $this->uuidPK(),
            'identity_id' => $this->uuid()->notNull(),
            'route'       => $this->string()->notNull(),
            'code'        => $this->integer()->notNull(),
            'referer'     => $this->string()->null(),
            'created_at'  => $this->dateTime()->notNull(),
        ]);

        $this->addFK(Tables::IdentityToken, Tables::Identity, 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(Tables::ActionLog->value);
    }
}
