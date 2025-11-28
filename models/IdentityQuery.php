<?php

namespace app\models;

use app\components\db\Record;
use app\enums\IdentityStatus;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class IdentityQuery extends ActiveQuery
{
    public function all($db = null): array
    {
        return parent::all($db);
    }

    public function one($db = null): null|Identity|Record|ActiveRecord
    {
        return parent::one($db);
    }

    public function byEmail(string $email): static
    {
        return $this->andWhere(['email' => $email]);
    }

    public function byStatus(IdentityStatus $status): static
    {
        return $this->andWhere(['status' => $status]);
    }
}