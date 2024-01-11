<?php

namespace app\forms;

use app\enum\IdentityStatus;
use app\enum\IdentityTokenType;
use app\models\IdentityToken;
use Throwable;
use Yii;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use yii\base\UserException;
use yii\db\StaleObjectException;

class SignupCompleteForm extends Model
{
    private ?IdentityToken $identityToken = null;

    public function __construct($token, array $config = [])
    {
        $this->identityToken = IdentityToken::findByToken($token, IdentityTokenType::Confirmation);
        if ($this->identityToken || $this->identityToken->isExpired) {
            throw new InvalidArgumentException(Yii::t('app', 'Invalid confirmation token'));
        }

        parent::__construct($config);
    }

    /**
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function verifyEmail(): bool
    {
        $identity = $this->identityToken->identity;
        $identity->setStatus(IdentityStatus::Active);
        $this->identityToken->delete();
        return true;
    }
}