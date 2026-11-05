<?php
namespace app\models;

use app\components\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class ExceptionLog extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%exception_log}}';
    }

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), []);
    }


}
