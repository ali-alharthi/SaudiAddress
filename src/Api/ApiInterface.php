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

namespace AliAlharthi\SaudiAddress\Api;

use AliAlharthi\SaudiAddress\ConfigInterface;

interface ApiInterface
{
    /**
     * Returns the API base url.
     *
     * @return  string
     */
    public function baseUrl();

    /**
     * Set the config.
     *
     * @param   \AliAlharthi\SaudiAddress\ConfigInterface  $config
     */
    public function setConfig(ConfigInterface $config);

    /**
     * Executes the HTTP request.
     *
     * @param   string  $httpMethod
     * @param   string  $url
     * @param   array   $parameters
     * @param   bool    $encode
     * @return  array
     */
    public function execute($httpMethod, $url, array $parameters = [], bool $encode = true);
}
