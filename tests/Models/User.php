<?php

namespace Envant\EloquentLockable\Tests\Models;

use Envant\EloquentLockable\Lockable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use Lockable;

    /** @var array */
    protected $fillable = [
        'id', 'email', 'locked_updating', 'locked_deletion'
    ];
}
