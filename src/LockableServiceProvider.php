<?php

namespace Envant\EloquentLockable;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class LockableServiceProvider extends ServiceProvider
{
    public function register()
    {
        Blueprint::macro('lockable', function () {
            $this->boolean('locked_deletion')->default(false);
            $this->boolean('locked_updating')->default(false);
        });
    }

    public function boot()
    {
    }
}
