<?php

namespace BotMan\Drivers\Whatsapp\Providers;

use BotMan\Drivers\Whatsapp\WhatsappDriver;
use Illuminate\Support\ServiceProvider;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Studio\Providers\StudioServiceProvider;

class WhatsappServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->isRunningInBotManStudio()) {
            $this->loadDrivers();

            $this->publishes([
                __DIR__.'/../../stubs/whatsapp.php' => config_path('botman/whatsapp.php'),
            ]);

            $this->mergeConfigFrom(__DIR__.'/../../stubs/whatsapp.php', 'botman.whatsapp');
        }

        $this->loadRoutesFrom(__DIR__.'/../Laravel/routes.php');
        $this->loadViewsFrom(__DIR__.'/../Laravel/views', 'botman-whatsapp');
        $this->publishes([
            __DIR__.'/../Laravel/views' => resource_path('views/vendor/botman-whatsapp'),
        ]);
    }

    /**
     * Load BotMan drivers.
     */
    protected function loadDrivers()
    {
        DriverManager::loadDriver(WhatsappDriver::class);
    }

    /**
     * @return bool
     */
    protected function isRunningInBotManStudio()
    {
        return class_exists(StudioServiceProvider::class);
    }
}
