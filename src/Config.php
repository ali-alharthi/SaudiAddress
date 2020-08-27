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
 * @version    1.3
 * @author     Ali Alharthi
 * @license    MIT
 * @copyright  (c) 2020, Ali Alharthi
 * @link       https://aalharthi.sa
 */

namespace AliAlharthi\SaudiAddress;

class Config implements ConfigInterface
{
    /**
     * The current package version.
     *
     * @var string
     */
    protected $version;

    /**
     * The Saudi National Address API key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * The Saudi National Address API subscription.
     *
     * @var string
     */
    protected $apiSubscription;

    /**
     * Enabling Cache
     *
     */
    protected $cache = true;

    /**
     * The application's information.
     *
     * @var array|null
     */
    protected $appInfo;

    /**
     * Constructor.
     *
     * @param   string  $version
     * @param   string  $apiKey
     * @param   string  $apiSubscription
     * @return  void
     */
    public function __construct($version, $apiKey, $apiSubscription = 'Development', $cache = true)
    {
        $this->setVersion($version);
        $this->setApiKey($apiKey ?: self::getEnvVariable('SNA_API_KEY', ''));
        $this->setApiSubscription($apiSubscription ?: self::getEnvVariable('SNA_API_SUBSCRIPTION', 'Development'));
        $this->setCache($cache ?: self::getEnvVariable('SNA_CACHE', true));
    }

    /**
     * Get env Variable.
     *
     * @param   string      $name
     * @param   string|null $default
     * @return string|null
     */
    private static function getEnvVariable($name, $default = null)
    {
        if (isset($_SERVER[$name])) {
            return (string) $_SERVER[$name];
        }

        if (PHP_SAPI === 'cli' && ($value = getenv($name)) !== false) {
            return (string) $value;
        }

        return $default;
    }

    /**
     * Returns the package version.
     *
     * @return  string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Sets the package version.
     *
     * @param   string  $version
     * @return  Config
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Returns the Saudi National Address API key.
     *
     * @return  string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Sets the Saudi National Address API key.
     *
     * @param   string  $apiKey
     * @return  Config
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Returns the Saudi National Address API subscription type.
     *
     * @return  string
     */
    public function getApiSubscription()
    {
        return $this->apiSubscription;
    }

    /**
     * Sets the Saudi National Address API subscription type.
     *
     * @param   string  $apiSubscription
     * @return  Config
     */
    public function setApiSubscription($apiSubscription)
    {
        $this->apiSubscription = $apiSubscription;

        return $this;
    }

    /**
     * Returns the cache status.
     *
     * @return  bool
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * Sets the cache status.
     *
     * @param   bool  $cache
     * @return  Config
     */
    public function setCache($cache)
    {
        $this->cache = $cache;

        return $this;
    }

}
