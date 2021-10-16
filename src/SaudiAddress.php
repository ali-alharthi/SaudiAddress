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
 * @version    2.0
 * @author     Ali Alharthi
 * @license    MIT
 * @copyright  (c) 2020, Ali Alharthi
 * @link       https://aalharthi.sa
 */

namespace AliAlharthi\SaudiAddress;

use ReflectionClass;

class SaudiAddress
{
    /**
     * The package version.
     *
     * @var string
     */
    const VERSION = 2.0;

    /**
     * The Config repository instance.
     *
     * @var \AliAlharthi\SaudiAddress\ConfigInterface
     */
    protected $config;

    /**
     * Constructor.
     *
     * @param   string  $apiKey
     * @param   string  $apiSubscription
     */
    public function __construct($apiKey = null, $apiSubscription = 'Development', $cache = false)
    {
        $this->config = new Config($apiKey, $apiSubscription, $cache);
    }

    /**
     * Create a new Saudi National Address API instance.
     *
     * @param   string   $apiKey
     * @param   string   $apiSubscription
     * @return  SaudiAddress
     */
    public static function make($apiKey = null, $apiSubscription = 'Development', $cache = false)
    {
        return new static($apiKey, $apiSubscription, $cache);
    }

    /**
     * Returns the current package version.
     *
     * @return  double
     */
    public static function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Returns the Config repository instance.
     *
     * @return  \AliAlharthi\SaudiAddress\ConfigInterface
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Sets the Config repository instance.
     *
     * @param   \AliAlharthi\SaudiAddress\ConfigInterface   $config
     * @return  SaudiAddress
     */
    public function setConfig(ConfigInterface $config)
    {
        $this->config = $config;

        return $this;
    }
    /**
     * Returns the Saudi National Address API key.
     *
     * @return  string
     */
    public function getApiKey()
    {
        return $this->config->getApiKey();
    }

    /**
     * Sets the Saudi National Address API key.
     *
     * @param   string  $apiKey
     * @return  SaudiAddress
     */
    public function setApiKey($apiKey)
    {
        $this->config->setApiKey($apiKey);

        return $this;
    }

    /**
     * Dynamically handle missing methods.
     *
     * @param   string  $method
     * @param   array   $parameters
     * @return  \AliAlharthi\SaudiAddress\Api\ApiInterface
     */
    public function __call($method, array $parameters)
    {
        return $this->getApiInstance($method);
    }

    /**
     * Returns the Api class instance for the given method.
     *
     * @param   string  $method
     * @return  \AliAlharthi\SaudiAddress\Api\ApiInterface
     * @throws  \BadMethodCallException
     */
    protected function getApiInstance($method)
    {
        $class = "\\AliAlharthi\SaudiAddress\\Api\\" . ucwords($method);

        if (class_exists($class) && !(new ReflectionClass($class))->isAbstract()) {
            return new $class($this->config);
        }

        throw new \BadMethodCallException("Undefined method [{$method}] called.");
    }
}
