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

class ShortAddress extends Api
{
    /**
     * The response array.
     *
     * @var  array|null
     */
    protected $response = null;

    /**
     * The cache directory.
     *
     * @var  string
     */
    protected $cacheDir = __DIR__ . '/cache/';

    /**
     * The cache file name.
     *
     * @var  string
     */
    protected $file = __DIR__ . '/cache/' . 'short_address_';

    /**
     * The short address.
     *
     * @var  string|null
     */
    protected $short = null;


    /**
     * Constructor.
     *
     * @param  \AliAlharthi\SaudiAddress\ConfigInterface  $config
     * @param  string  $short
     */
    function __construct($config, $short)
    {
        parent::__construct($config);
        $this->checkShortAddressFormat($short);
        $this->short = $short;
    }

    /**
     * Returns the full address from a short address.
     *
     * @return  ShortAddress
     */
    public function fullAddress()
    {
        $cache = $this->file . preg_replace('/[^a-zA-Z0-9_]/', '_', $this->short) . '_' . strtolower($this->config->getLocale()) . '.data';

        $this->response = $this->cacheValue($cache);

        if ($this->response == null) {
            $response = $this->_get(
                'NationalAddressByShortAddress/NationalAddressByShortAddress',
                [
                    'shortaddress'      => $this->short,
                ],
                false
            );

            if ($response['success'] == false) {
                return;
            }

            $addresses = $response;

            if($this->config->getCache()){
                (!file_exists($this->cacheDir)) ?
                    mkdir($this->cacheDir, 0777, false) : ((file_exists($cache)) ? unlink($cache) : touch($cache));
                file_put_contents($cache, serialize($addresses));
            }
            $this->response = $addresses;

        }

        return $this->response['Addresses'][0] ?? array();
    }

    /**
     * Verify an address.
     *
     * @return  bool
     */
    public function verify()
    {
        if($this->response !== null){
            return (bool) ((int) $this->response['totalSearchResults'] > 0);
        }

        $skipReturn = $this->fullAddress();

        return (bool) ((int) $this->response['totalSearchResults'] > 0);
    }

    /**
     * Returns the geo location from a short address.
     *
     * @return  array
     */
    public function geo()
    {
        $cache = $this->file . preg_replace('/[^a-zA-Z0-9_]/', '_', $this->short) . '_geo_' . strtolower($this->config->getLocale()) . '.data';

        $response = $this->cacheValue($cache);

        if ($response == null) {
            $response = $this->_get(
                'GeoCodeByShortAddress/GeoCodeByShortlAddress',
                [
                    'shortaddress'      => $this->short,
                ],
                false
            );

            if ($response['success'] == false) {
                return;
            }

            $addresses = $response['Addresses'];

            if($this->config->getCache()){
                (!file_exists($this->cacheDir)) ?
                    mkdir($this->cacheDir, 0777, false) : ((file_exists($cache)) ? unlink($cache) : touch($cache));
                file_put_contents($cache, serialize($addresses));
            }
            $response = $addresses;

        }

        return $this->response['Addresses'][0] ?? [];
    }

    /**
     * Returns the geo location from a short address.
     *
     * @return  array
     */
    public function coordinates()
    {
        $this->geo();
    }

    /**
     * Check if find() method was called first.
     *
     * @param   string  $shortAddress
     * @return  void
     * @throws  \AliAlharthi\SaudiAddress\Exception\SaudiAddressException
     */
    protected function checkShortAddressFormat($shortAddress)
    {
        if (!preg_match('/^[A-Z]{4}\d{4}$/', $shortAddress) > 0) {
            throw new \AliAlharthi\SaudiAddress\Exception\SaudiAddressException("Incorrect short address format: should consists of 4 letters followed by 4 numbers.");
        }
    }
}
