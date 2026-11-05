<?php

use app\components\migrations\Migration;
use app\enums\Tables;

class m261020_212342_create__auth_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(Tables::AuthLog->value, [
            'id'         => $this->uuidPK(),
            'email'      => $this->string()->notNull(),
            'success'    => $this->boolean()->notNull(),
            'ip'         => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(Tables::AuthLog->value);
    }
}
