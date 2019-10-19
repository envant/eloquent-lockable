<?php

namespace Envant\EloquentLockable;

use Envant\EloquentLockable\Exceptions\DeletingLockedException;
use Envant\EloquentLockable\Exceptions\UpdatingLockedException;

trait Lockable
{
    /**
     * @return bool
     */
    public function getLockedDeletionAttribute(): bool
    {
        return (bool) $this->attributes['locked_deletion'];
    }

    /**
     * @return bool
     */
    public function getLockedUpdatingAttribute(): bool
    {
        return (bool) $this->attributes['locked_updating'];
    }

    public static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            if ($model->locked_updating) {
                throw new UpdatingLockedException($model);
            }
        });

        static::deleting(function ($model) {
            if ($model->locked_deletion) {
                throw new DeletingLockedException($model);
            };
        });
    }
}
