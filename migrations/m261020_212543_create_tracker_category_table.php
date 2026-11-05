<?php

use app\components\migrations\Migration;
use app\enums\Tables;

class m261020_212543_create_tracker_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(Tables::TrackerCategory->value, [
            'id'          => $this->uuidPK(),
            'tracker_id'  => $this->uuid()->notNull(),
            'name'        => $this->string()->notNull()->unique(),
            'url'         => $this->string()->notNull()->unique(),
            'description' => $this->text()->null(),
            'created_at'  => $this->dateTime()->notNull(),
            'updated_at'  => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(Tables::TrackerCategory->value);
    }
}
