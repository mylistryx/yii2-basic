<?php

namespace app\components\db;

use app\components\behaviors\DateTimeBehavior;
use app\components\behaviors\UuidBehavior;
use Exception;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord as BaseActiveRecord;
use function array_key_exists;
use function is_array;

/**
 * @inheritDoc
 */
abstract class ActiveRecord extends BaseActiveRecord
{
    public bool $useUuidInsteadInt = false;
    public string|false $createdAtAttribute = false;
    public string|false $updatedAtAttribute = false;

    public string|false $createdByAttribute = false;
    public string|false $updatedByAttribute = false;
    public string|false $isActiveAttribute = false;

    /**
     * @return array
     * @throws Exception
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        if ($this->useUuidInsteadInt) {
            $behaviors['Uuid'] = [
                'class' => UuidBehavior::class,
            ];
        }

        if ($this->createdAtAttribute || $this->updatedAtAttribute) {
            $behaviors['DateTime'] = [
                'class' => DateTimeBehavior::class,
                'createdAtAttribute' => $this->createdAtAttribute,
                'updatedAtAttribute' => $this->updatedAtAttribute,
            ];
        }

        if ($this->createdByAttribute || $this->updatedByAttribute) {
            $behaviors['Blameable'] = [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => $this->createdByAttribute,
                'updatedByAttribute' => $this->updatedByAttribute,
            ];
        }

        return $behaviors;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        $rules = parent::rules();

        if ($this->isActiveAttribute) {
            $rules[] = [$this->isActiveAttribute, 'required'];
            $rules[] = [$this->isActiveAttribute, 'boolean'];
        }
        return $rules;
    }

    public function relations(): array
    {
        return [];
    }

    public function getRelation($name, $throwException = true): ActiveQueryInterface|ActiveQuery|null
    {
        $relations = $this->relations();
        if (array_key_exists($name, $relations)) {
            $relation = $relations[$name];

            if (is_array($relation)) {
                return $this->hasMany($relation[0], [$name . '_id' => 'id']);
            }

            return $this->hasOne($relation, ['id' => $name . '_id']);
        }

        return parent::getRelation($name, $throwException);
    }

    public function attributeLabels(): array
    {
        $labels = parent::attributeLabels();

        if ($this->createdAtAttribute) {
            $labels[$this->createdAtAttribute] = Yii::t('app', 'Created at');
        }
        if ($this->updatedAtAttribute) {
            $labels[$this->updatedAtAttribute] = Yii::t('app', 'Updated at');
        }
        if ($this->isActiveAttribute) {
            $labels[$this->isActiveAttribute] = Yii::t('app', 'Is active');
        }

        return $labels;
    }

    /**
     * @param string|null $isActiveAttribute
     * @return bool
     * @throws Exception
     */
    public function toggle(?string $isActiveAttribute = null): bool
    {
        if ($isActiveAttribute && $this->hasAttribute($isActiveAttribute)) {
            $currentStatus = $this->getAttribute($isActiveAttribute);
            $this->setAttribute($isActiveAttribute, !$currentStatus);
            return ($this->isAttributeChanged($isActiveAttribute) && $this->save());
        }

        return false;
    }
}
