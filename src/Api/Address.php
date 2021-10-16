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

class Address extends Api
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
     * @var string
     */
    protected $file = __DIR__ . '/cache/' . 'address_';

    /**
     * Constructor.
     *
     * @param   \AliAlharthi\SaudiAddress\ConfigInterface  $config
     */
    public function __construct($config)
    {
        parent::__construct($config);
    }

    /**
     * Free text address search.
     *
     * @param   string  $address
     * @param   int     $page
     * @return  Address
     */
    public function search($address, $page = 1)
    {
        $cache = $this->file . preg_replace('/[^a-zA-Z0-9_]/', '_', $address) . '_' . strtolower($this->config->getLocale()) . '.data';

        $this->response = $this->cacheValue($cache);

        if ($this->response == null) {
            $response = $this->_get(
                'v4/Address/address-free-text',
                [
                    'addressstring' => $address,
                    'page' => $page,
                ],
                false
            );
            if ($response['success'] == false) {
                return;
            }
            $addresses = $response['Addresses'];
            $pages = (int) ceil($response['totalSearchResults'] / 20);
            if ($page == 1 && ($pages > 1)) {
                for ($i = 2; $i <= $pages; $i++) {
                    // 1 call allowed per 5 seconds (on Development subscription)
                    ($this->config->getApiSubscription() == 'Development') ? sleep(5) : '';
                    $pageData = $this->_get(
                        'v4/Address/address-free-text',
                        [
                            'addressstring' => $address,
                            'page' => $i,
                        ],
                        false
                    );

                    $pageData = $pageData['Addresses'];
                    $pageData = array_combine(range(($i * 10), count($pageData) + (($i * 10) - 1)), array_values($pageData));
                    $addresses += $pageData;
                }
            }
            if($this->config->getCache()){
                (!file_exists($this->cacheDir)) ?
                    mkdir($this->cacheDir, 0777, false) : ((file_exists($cache)) ? unlink($cache) : touch($cache));
                file_put_contents($cache, serialize($addresses));
            }
            $this->response = $addresses;
        }

        return $this;
    }
    /**
     * Constructor.
     *
     * @param   string  $address
     * @param   int     $page
     * @return  Address
     */
    public function find($address = null, $page = 1)
    {
        $this->search($address, $page);
    }

    /**
     * Returns all the addresses found.
     *
     * @return  array
     */
    public function all()
    {
        $this->check();

        return $this->response;
    }

    /**
     * Returns all the addresses found.
     *
     * @return  array
     */
    public function get()
    {
        return $this->all();
    }

    /**
     * Verify an address.
     *
     * @param   int     $buildingNumber
     * @param   int     $zip
     * @param   int     $additionalNumber
     * @return  bool
     */
    public function verify($buildingNumber, $zip, $additionalNumber)
    {
        $cache = $this->file . $buildingNumber . '_' .$zip . '_' .$additionalNumber . '_' . strtolower($this->config->getLocale()) . '.data';

        $response = $this->cacheValue($cache);

        if ($response == null) {

            $response = $this->_get(
                'v3.1/Address/address-verify',
                [
                    'buildingnumber'    => $buildingNumber,
                    'zipcode'           => $zip,
                    'additionalnumber'  => $additionalNumber,
                ]
            );
        }

        if($this->config->getCache()){
            (!file_exists($this->cacheDir)) ?
                mkdir($this->cacheDir, 0777, false) : ((file_exists($cache)) ? unlink($cache) : touch($cache));
            file_put_contents($cache, serialize($response));
        }

        return (bool) $response['addressfound'];
    }

    /**
     * Check if find() method was called first.
     *
     * @return  void
     * @throws  \BadMethodCallException
     */
    protected function check()
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call search() or find() methods first.");
        }
    }
}
