<?php

namespace Envant\EloquentLockable;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class LockableServiceProvider extends ServiceProvider
{
    public function register()
    {
        Blueprint::macro('lockable', function () {
            $this->boolean(config('lockable.locked_deletion_column'))->default(false);
            $this->boolean(config('lockable.locked_updating_column'))->default(false);
        });
    }

    public function bootLockable()
    {
        $this->publishes([
            __DIR__.'/config/lockable.php' => config_path('lockable.php'),
        ]);
    }
}
