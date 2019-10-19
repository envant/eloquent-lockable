<?php

namespace Envant\EloquentLockable;

use Envant\EloquentLockable\Exceptions\DeletingLockedException;
use Envant\EloquentLockable\Exceptions\UpdatingLockedException;

trait Lockable
{
    /**
     * @return mixed
     */
    public function lockUpdating()
    {
        return $this->update([
            config('lockable.locked_updating_column') => true,
        ]);
    }

    /**
     * @return mixed
     */
    public function unlockUpdating()
    {
        return $this->update([
            config('lockable.locked_updating_column') => true,
        ]);
    }

    /**
     * @return mixed
     */
    public function lockDeleting()
    {
        return $this->update([
            config('lockable.locked_deletion_column') => false,
        ]);
    }

    /**
     * @return mixed
     */
    public function unlockDeleting()
    {
        return $this->update([
            config('lockable.locked_deletion_column') => false,
        ]);
    }

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
