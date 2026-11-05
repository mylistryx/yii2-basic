<?php

namespace app\components\migrations;

use app\enums\Tables;
use yii\db\ColumnSchemaBuilder;

use function sprintf;
use function ucfirst;

class Migration extends \yii\db\Migration
{
    public function uuid(): ColumnSchemaBuilder
    {
        return $this->string(36);
    }

    public function uuidPK(): ColumnSchemaBuilder
    {
        return $this->string(36)->notNull()->append('PRIMARY KEY');
    }

    public function addFK(Tables $fromTable, Tables $toTable, ?string $onDelete, ?string $onUpdate): void
    {
        $this->addForeignKey(
            $this->generateFkName($fromTable, $toTable),
            $fromTable->value,
            sprintf('%s_id', $toTable->value),
            $toTable->value,
            'id',
            $onDelete,
            $onUpdate,
        );
    }

    public function dropFk(Tables $table, Tables $relatedTable): void
    {
        $this->dropForeignKey(
            $this->generateFkName($table, $relatedTable),
            $table->value,
        );
    }

    protected function generateFkName(Tables $table, Tables $relatedTable): string
    {
        return sprintf(
            'FK_%s_%sId__%s_Id',
            $table->name,
            $relatedTable->name,
            $relatedTable->name,
        );
    }

    public function createIdx(Tables $table, string $column): void
    {
        parent::createIndex($this->generateIndexName($table, $column), $table->value, $column);
    }

    protected function generateIndexName(Tables $table, string $column): string
    {
        return sprintf('idx%s_%s', $table->name, ucfirst($column));
    }
}
