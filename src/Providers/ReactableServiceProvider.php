<?php

namespace Yuges\Reactable\Providers;

use TypeError;
use Yuges\Reactable\Config\Config;
use Yuges\Reactable\Models\Reaction;
use Illuminate\Support\ServiceProvider;
use Yuges\Reactable\Observers\ReactionObserver;

class ReactableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $class = Config::getReactionClass(Reaction::class);

        if (! is_a(new $class, Reaction::class)) {
            throw new TypeError('Invalid reaction model');
        }

        $class::observe(new ReactionObserver);

        $this->publishes([
            __DIR__.'/../../config/reactable.php' => config_path('reactable.php')
        ], 'reactable-config');

        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('migrations')
        ], 'reactable-migrations');

        $this->publishes([
            __DIR__.'/../../database/seeders/' => database_path('seeders')
        ], 'reactable-seeders');
    }
}
