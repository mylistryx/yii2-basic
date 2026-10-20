<?php

declare(strict_types=1);

namespace app\tests\Unit\Models;

use app\models\Identity;

final class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        /** @var Identity $user */
        $user = Identity::findIdentity(100);

        verify($user)->notEmpty();
        verify($user->username)->equals('admin');
        verify(Identity::findIdentity(999))->empty();
    }

    public function testFindUserByAccessToken()
    {
        /** @var Identity $user */
        $user = Identity::findIdentityByAccessToken('100-token');

        verify($user)->notEmpty();
        verify($user->username)->equals('admin');
        verify(Identity::findIdentityByAccessToken('non-existing'))->empty();
    }

    public function testFindUserByUsername()
    {
        /** @var Identity $user */
        $user = Identity::findByUsername('admin');

        verify($user)->notEmpty();
        verify(Identity::findByUsername('not-admin'))->empty();
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser()
    {
        /** @var Identity $user */
        $user = Identity::findByUsername('admin');

        verify($user->validateAuthKey('test100key'))->notEmpty();
        verify($user->validateAuthKey('test102key'))->empty();
    }
}
