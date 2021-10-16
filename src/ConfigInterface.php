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

interface ConfigInterface
{
    /**
    * Returns the current package version.
    *
    * @return   string
    */
    public function getVersion();

    /**
     * Returns the Saudi National Address API key.
     *
     * @return  string
     */
    public function getApiKey();

    /**
     * Sets the Saudi National Address API key.
     *
     * @param   string  $apiKey
     * @return  ConfigInterface
     */
    public function setApiKey($apiKey);

    /**
     * Returns the Saudi National Address API subscription type.
     *
     * @return  string
     */
    public function getApiSubscription();

    /**
     * Sets the Saudi National Address API subscription type.
     *
     * @param   string  $apiSubscription
     * @return  ConfigInterface
     */
    public function setApiSubscription($apiSubscription);

    /**
     * Returns the cache status.
     *
     * @return  bool
     */
    public function getCache();

    /**
     * Sets the cache status.
     *
     * @param   bool  $cache
     * @return  Config
     */
    public function setCache($cache);
}
