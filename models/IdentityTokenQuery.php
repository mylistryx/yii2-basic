<?php

namespace app\models;

use app\components\db\Record;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class IdentityTokenQuery extends ActiveQuery
{
    public function all($db = null): array
    {
        return parent::all($db);
    }

    public function one($db = null): null|IdentityToken|Record|ActiveRecord
    {
        return parent::one($db);
    }
}