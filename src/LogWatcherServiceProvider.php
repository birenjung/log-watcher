<?php

namespace Birenjung\LogWatcher;

use Illuminate\Support\ServiceProvider;
use Birenjung\LogWatcher\Commands\WatchLogCommand;

class LogWatcherServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if (! $this->app->environment('local')) {
            return;
        }

        $this->mergeConfigFrom(
            __DIR__ . '/../config/log-watcher.php',
            'log-watcher'
        );
    }

    public function boot(): void
    {
        if (! $this->app->environment('local')) {
            return;
        }

        $this->publishes([
            __DIR__ . '/../config/log-watcher.php' =>
            config_path('log-watcher.php'),
        ], 'log-watcher-config');

        $this->commands([
            WatchLogCommand::class,
        ]);
    }
}
