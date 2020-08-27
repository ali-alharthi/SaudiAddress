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

class Districts extends Api
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
    protected $file = __DIR__ . '/cache/' . 'districts_';

    /**
     * Returns a list of all the districts in a city.
     *
     * @param   int     $cityId
     * @param   string  $lang
     * @return  Districts
     */
    public function all($cityId = 1, $lang = 'A')
    {

        $cache = $this->file . $cityId . '_' . strtolower($lang) .  '.data';
        if ($this->config->getCache() && file_exists($cache)) {
            $this->response = unserialize(file_get_contents($cache));
        }
        if ($this->response == null) {
            $response = $this->_get(
                'v3.1/lookup/districts',
                $lang,
                [
                    'cityid' => $cityId
                ]
            );
            if ($this->config->getCache()) {
                (!file_exists($this->cacheDir)) ?
                    mkdir($this->cacheDir, 0755, false) : ((file_exists($cache)) ? unlink($cache) : touch($cache));
                file_put_contents($cache, serialize($response));
            }
            $this->response = $response;
        }

        return $this;
    }

    /**
     * Returns a the response.
     *
     * @return  array
     */
    public function get()
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call all() method first.");
        }

        return $this->response['Districts'];
    }

    /**
     * Returns a specific district from a city by ID.
     *
     * @param   int     $districtId
     * @return  array
     */
    public function getId(int $districtId)
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call all() method first.");
        }

        $key = array_search($districtId, array_column($this->response['Districts'], 'Id'));

        return $this->response['Districts'][$key];
    }

    /**
     * Returns a specific district from a city by ID.
     *
     * @param   int     $districtId
     * @return  array
     */
    public function byId(int $districtId)
    {
        return $this->getId($districtId);
    }

    /**
     * Returns a specific district from a city by ID.
     *
     * @param   int     $districtId
     * @return  array
     */
    public function id(int $districtId)
    {
        return $this->getId($districtId);
    }

    /**
     * Returns a certian district from a city by name.
     *
     * @param   string  $districtName
     * @return  array
     */
    public function getName($districtName)
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call all() method first.");
        }

        $key = array_search($districtName, array_column($this->response['Districts'], 'Name'));

        return $this->response[$key];
    }

    /**
     * Returns a certian district from a city by name.
     *
     * @param   string  $districtName
     * @return  array
     */
    public function byName($districtName)
    {
        return $this->getName($districtName);
    }

    /**
     * Returns a certian district from a city by name.
     *
     * @param   string  $districtName
     * @return  array
     */
    public function named($districtName)
    {
        return $this->getName($districtName);
    }

    /**
     * Returns a certian district from a city by name.
     *
     * @param   string  $districtName
     * @return  array
     */
    public function districtName($districtName)
    {
        return $this->getName($districtName);
    }
}
