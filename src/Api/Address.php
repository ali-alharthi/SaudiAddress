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

namespace AliAlharthi\SaudiAddress\Api;

class Address extends Api
{
    /**
     * The response array.
     *
     * @var array|null
     */
    protected $response = null;

    /**
     * The cache directory.
     *
     * @var string|null
     */
    protected $cacheDir = __DIR__ . '/cache/';

    /**
     * The cache file name.
     *
     * @var string|null
     */
    protected $file = __DIR__ . '/cache/' . 'address_';

    /**
     * Returns a list of all the addresses from a string.
     *
     * @param   string  $address
     * @param   int     $page
     * @param   string  $lang
     * @return  Address
     */
    public function find($address, $page = 1, $lang = 'A')
    {
        $cache = $this->file . preg_replace('/[^a-zA-Z0-9_]/', '_', $address) . '_' . strtolower($lang) . '.data';

        $this->response = $this->cacheValue($cache);

        if ($this->response == null) {
            $response = $this->_get(
                'v4/Address/address-free-text',
                $lang,
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
                        $lang,
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
     * @param   string  $lang
     * @return  array
     */
    public function verify($buildingNumber, $zip, $additionalNumber, $lang = 'A')
    {
        $response = $this->_get(
            'v3.1/Address/address-verify',
            $lang,
            [
                'buildingnumber'    => $buildingNumber,
                'zipcode'           => $zip,
                'additionalnumber'  => $additionalNumber,
            ]
        );

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
            throw new \BadMethodCallException("You need to call find() method first.");
        }
    }
}
