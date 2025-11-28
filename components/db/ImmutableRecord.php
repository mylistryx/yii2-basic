<?php

namespace app\components\db;

use RuntimeException;

abstract class ImmutableRecord extends Record
{
    public function save($runValidation = true, $attributeNames = null): bool
    {
        throw new RuntimeException('Not implemented');
    }

    public function insert($runValidation = true, $attributes = null): bool
    {
        throw new RuntimeException('Not implemented');
    }

    public function update($runValidation = true, $attributeNames = null): bool
    {
        throw new RuntimeException('Not implemented');
    }

    public function batchInsert($runValidation = true, $attributeNames = null): bool
    {
        throw new RuntimeException('Not implemented');
    }

    public function batchUpdate($runValidation = true, $attributeNames = null): bool
    {
        throw new RuntimeException('Not implemented');
    }

    public function delete($runValidation = true, $attributeNames = null): bool
    {
        throw new RuntimeException('Not implemented');
    }

    public static function deleteAll($condition = '', $params = []): bool
    {
        throw new RuntimeException('Not implemented');
    }
}