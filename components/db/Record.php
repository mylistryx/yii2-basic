<?php

namespace app\components\db;

use app\behaviors\DateTimeBehavior;
use ReflectionClass;
use Throwable;
use Yii;
use yii\db\ActiveRecord;

abstract class Record extends ActiveRecord
{
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        if ($this->canSetProperty('created_at')) {
            $createdAtAttribute = 'created_at';
            $updatedAtAttribute = $this->canSetProperty('updated_at') ? 'updated_at' : false;

            $behaviors['DateDime'] = [
                'class' => DateTimeBehavior::class,
                'createdAtAttribute' => $createdAtAttribute,
                'updatedAtAttribute' => $updatedAtAttribute,
            ];
        }

        return $behaviors;
    }

    private static function getTCategory(): string
    {
        return new ReflectionClass(static::class)->getShortName();
    }

    /**
     * @param string $attribute
     * @param array $params
     * @return string
     */
    public static function t(string $attribute, array $params = []): string
    {
        return Yii::t(static::getTCategory(), $attribute, $params);
    }

    /**
     * @param bool $runValidation
     * @param $attributeNames
     * @return bool
     */
    public function save($runValidation = true, $attributeNames = null): bool
    {
        try {
            return parent::save($runValidation, $attributeNames);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * @return false|int
     */
    public function delete(): false|int
    {
        try {
            return parent::delete();
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * @param bool $runValidation
     * @param $attributes
     * @return bool
     */
    public function insert($runValidation = true, $attributes = null): bool
    {
        try {
            return parent::insert($runValidation, $attributes);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * @param bool $runValidation
     * @param $attributeNames
     * @return bool
     */
    public function update($runValidation = true, $attributeNames = null): bool
    {
        try {
            return parent::update($runValidation, $attributeNames);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }
}