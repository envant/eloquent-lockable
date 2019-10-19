<?php

namespace Envant\EloquentLockable;

use Envant\EloquentLockable\Exceptions\DeletingLockedException;
use Envant\EloquentLockable\Exceptions\UpdatingLockedException;

trait Lockable
{
    public static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            if ((bool) $model->locked_updating) {
                throw new UpdatingLockedException($model);
            }
        });

        static::deleting(function ($model) {
            if ((bool) $model->locked_deletion) {
                throw new DeletingLockedException($model);
            };
        });
    }
}
