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
     * Sets the current package version.
     *
     * @param    double  $version
     * @return   ConfigInterface
     */
    public function setVersion($version);

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
     * Returns the application's information.
     *
     * @return void
     */
    public function getAppInfo();

    /**
     * Sets the application's information.
     *
     * @param   string  $appVersion
     * @param   string  $apiSubscription
     * @return  ConfigInterface
     */
    public function setAppInfo($appVersion = null, $apiSubscription = 'Development');

}
