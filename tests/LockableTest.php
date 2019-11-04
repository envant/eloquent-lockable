<?php

use Envant\EloquentLockable\Exceptions\DeletingLockedException;
use Envant\EloquentLockable\Exceptions\UpdatingLockedException;
use Envant\EloquentLockable\Tests\TestCase;

class LockableTest extends TestCase
{
    public function testLockUpdating()
    {
        $this->expectException(UpdatingLockedException::class);

        $this->testUser->lockUpdating();
        $this->testUser->update(['email' => 'test2@example.com']);
    }

    public function testUnlockUpdating()
    {
        $this->testUser->unlockUpdating();
        $this->testUser->update(['email' => 'test2@example.com']);

        $this->assertDatabaseHas('users', [
            'email' => 'test2@example.com',
        ]);
    }

    public function testLockDeletion()
    {
        $this->expectException(DeletingLockedException::class);
        $this->testUser->lockDeleting();
        $this->testUser->delete();
    }

    public function testUnlockDeletion()
    {
        $this->testUser->unlockDeleting();

        $this->assertDatabaseMissing('users', [
            'email' => 'test2@example.com',
        ]);
    }
}
