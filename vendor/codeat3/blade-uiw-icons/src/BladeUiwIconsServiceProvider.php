<?php

declare(strict_types=1);

namespace Codeat3\BladeUiwIcons;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

final class BladeUiwIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-uiw-icons', []);

            $factory->add('uiw-icons', array_merge(['path' => __DIR__ . '/../resources/svg'], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/blade-uiw-icons.php', 'blade-uiw-icons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/svg' => public_path('vendor/blade-uiw-icons'),
            ], 'blade-uiw-icons');

            $this->publishes([
                __DIR__ . '/../config/blade-uiw-icons.php' => $this->app->configPath('blade-uiw-icons.php'),
            ], 'blade-uiw-icons-config');
        }
    }
}
