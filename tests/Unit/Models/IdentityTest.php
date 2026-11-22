<?php

declare(strict_types=1);

namespace app\tests\Unit\Models;

use app\models\Identity;

final class IdentityTest extends \Codeception\Test\Unit
{
    public function testFindIdentityById()
    {
        /** @var Identity $user */
        $user = Identity::findIdentity(100);

        verify($user)->notEmpty();
        verify($user->username)->equals('admin');
        verify(Identity::findIdentity(999))->empty();
    }

    public function testFindIdentityByAccessToken()
    {
        /** @var Identity $user */
        $user = Identity::findIdentityByAccessToken('100-token');

        verify($user)->notEmpty();
        verify($user->username)->equals('admin');
        verify(Identity::findIdentityByAccessToken('non-existing'))->empty();
    }

    public function testFindIdentityByUsername()
    {
        /** @var Identity $user */
        $user = Identity::findByUsername('admin');

        verify($user)->notEmpty();
        verify(Identity::findByUsername('not-admin'))->empty();
    }

    /**
     * @depends testFindIdentityByUsername
     */
    public function testValidateIdentity()
    {
        /** @var Identity $user */
        $user = Identity::findByUsername('admin');

        verify($user->validateAuthKey('test100key'))->notEmpty();
        verify($user->validateAuthKey('test102key'))->empty();
    }
}
