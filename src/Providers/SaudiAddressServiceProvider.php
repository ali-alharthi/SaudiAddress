<?php

/*
 * Part of the Saudi Address API PHP package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the MIT.
 *
 * This source file is subject to the MIT License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Saudi Address
 * @version    1.2
 * @author     Ali Alharthi
 * @license    MIT
 * @copyright  (c) 2020, Ali Alharthi
 * @link       https://aalharthi.sa
 */

namespace AliAlharthi\SaudiAddress\Providers;

use AliAlharthi\SaudiAddress\Config;
use AliAlharthi\SaudiAddress\SaudiAddress;
use AliAlharthi\SaudiAddress\ConfigInterface;
use Illuminate\Support\ServiceProvider;

class SaudiAddressServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerSaudiAddress();
        $this->registerConfig();
    }

    public function provides()
    {
        return [
            'saudiaddress',
            'saudiaddress.config',
        ];
    }

    /**
     * Register the Saudi National Address API class.
     *
     * @return void
     */
    protected function registerSaudiAddress()
    {
        $this->app->singleton('saudiaddress', function ($app) {
            $config = $app['config']->get('services.saudiaddress');

            $apiKey = $config['api_key'] ?? null;

            $apiSubscription = $config['api_subscription'] ?? null;

            $cache = $config['cache'] ?? null;

            return new SaudiAddress($apiKey, $apiSubscription, $cache);
        });

        $this->app->alias('saudiaddress', SaudiAddress::class);
    }

    /**
     * Register the config class.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->app->singleton('saudiaddress.config', function ($app) {
            return $app['saudiaddress']->getConfig();
        });

        $this->app->alias('saudiaddress.config', Config::class);

        $this->app->alias('saudiaddress.config', ConfigInterface::class);
    }
}
