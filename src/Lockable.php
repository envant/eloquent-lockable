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
        if ($this->fireModelEvent('lockingUpdates') === false) {
            return false;
        }

        $this[config('lockable.locked_updating_column')] = true;

        $result = $this->save();

        $this->fireModelEvent('lockedUpdates', false);

        return $result;
    }

    /**
     * @return mixed
     */
    public function unlockUpdating()
    {
        if ($this->fireModelEvent('unlockingUpdates') === false) {
            return false;
        }

        $this[config('lockable.locked_updating_column')] = false;

        $result = $this->save();

        $this->fireModelEvent('unlockedUpdates', false);

        return $result;
    }

    /**
     * @return mixed
     */
    public function lockDeleting()
    {
        if ($this->fireModelEvent('lockingDeletes') === false) {
            return false;
        }

        $this[config('lockable.locked_deletion_column')] = true;

        $result = $this->save();

        $this->fireModelEvent('lockedDeletes', false);

        return $result;
    }

    /**
     * @return mixed
     */
    public function unlockDeleting()
    {
        if ($this->fireModelEvent('unlockingDeletes') === false) {
            return false;
        }

        $this[config('lockable.locked_deletion_column')] = false;

        $result = $this->save();

        $this->fireModelEvent('lockedDeletes', false);

        return $result;
    }

    public static function lockingUpdates($callback)
    {
        static::registerModelEvent('lockingUpdates', $callback);
    }

    public static function lockedUpdates($callback)
    {
        static::registerModelEvent('lockedUpdates', $callback);
    }

    public static function unlockingUpdates($callback)
    {
        static::registerModelEvent('unlockingUpdates', $callback);
    }

    public static function unlockedUpdates($callback)
    {
        static::registerModelEvent('unlockedUpdates', $callback);
    }

    public static function lockingDeletes($callback)
    {
        static::registerModelEvent('lockingDeletes', $callback);
    }

    public static function lockedDeletes($callback)
    {
        static::registerModelEvent('lockedDeletes', $callback);
    }

    public static function unlockingDeletes($callback)
    {
        static::registerModelEvent('unlockingDeletes', $callback);
    }

    public static function unlockedDeletes($callback)
    {
        static::registerModelEvent('unlockedDeletes', $callback);
    }

    public static function bootLockable()
    {
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
