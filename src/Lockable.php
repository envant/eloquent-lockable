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
            if ((bool) $model->locked_updating[config('lockable.locked_updating_column')]) {
                throw new UpdatingLockedException();
            }
        });

        static::deleting(function ($model) {
            if ((bool) $model[config('lockable.locked_deletion_column')]) {
                throw new DeletingLockedException();
            };
        });
    }
}
