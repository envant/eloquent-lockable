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
        $this[config('lockable.locked_updating_column')] = true;

        return $this->save();
    }

    /**
     * @return mixed
     */
    public function unlockUpdating()
    {
        $this[config('lockable.locked_updating_column')] = false;

        return $this->save();
    }

    /**
     * @return mixed
     */
    public function lockDeleting()
    {
        $this[config('lockable.locked_deletion_column')] = true;

        return $this->save();
    }

    /**
     * @return mixed
     */
    public function unlockDeleting()
    {
        $this[config('lockable.locked_deletion_column')] = false;

        return $this->save();
    }

    public static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            if ((bool) $model[config('lockable.locked_updating_column')]) {
                throw new UpdatingLockedException();
            }
        });

        static::deleting(function ($model) {
            if ((bool) $model[config('lockable.locked_deletion_column')]) {
                throw new DeletingLockedException();
            }
        });
    }
}
