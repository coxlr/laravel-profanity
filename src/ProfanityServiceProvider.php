<?php

namespace Coxlr\Profanity;

use Illuminate\Support\ServiceProvider;

class ProfanityServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/profanity.php' => config_path('profanity.php'),
            ], 'config');
        }
    }

    public function register(): void
    {
        $this->app->singleton('profanity', function () {
            return $this->createProfanity();
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/profanity.php', 'profanity');
    }

    protected function createProfanity(): Profanity
    {
        return new Profanity();
    }
}
