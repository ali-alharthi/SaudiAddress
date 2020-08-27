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

class Cities extends Api
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
    protected $file = __DIR__ . '/cache/' . 'cities_';

    /**
     * Returns a list of all the cities in a region.
     *
     * @param   int     $regionId
     * @param   string  $lang
     * @return  Cities
     */
    public function all($regionId = -1, $lang = 'A')
    {
        $cache = ($regionId == -1) ? $this->file . 'all_' . strtolower($lang) .'.data' : $this->file . $regionId . '_'. strtolower($lang) .'.data';
        $this->currentLang = $lang;
        if ($this->config->getCache() && file_exists($cache)) {
            $this->response = unserialize(file_get_contents($cache));
        }

        if ($this->response == null) {
            $response = $this->_get(
                'v3.1/lookup/cities',
                $lang,
                [
                    'regionid' => $regionId
                ]
            );
            if ($this->config->getCache()) {
                (!file_exists($this->cacheDir)) ?
                mkdir($this->cacheDir, 0777, false) : ((file_exists($cache)) ? unlink($cache) : touch($cache));
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

        return $this->response['Cities'];
    }

    /**
     * Returns a specific city from a region by ID.
     *
     * @param   int     $cityId
     * @return  array
     */
    public function getId(int $cityId)
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call all() method first.");
        }

        $key = array_search($cityId, array_column($this->response['Cities'], 'Id'));

        return $this->response['Cities'][$key];
    }

    /**
     * Returns a specific city from a region by ID.
     *
     * @param   int     $cityId
     * @return  array
     */
    public function byID(int $cityId)
    {
        return $this->getId($cityId);
    }

    /**
     * Returns a specific city from a region by ID.
     *
     * @param   int     $cityId
     * @return  array
     */
    public function id(int $cityId)
    {
        return $this->getId($cityId);
    }

    /**
     * Returns a certian city from a region by name.
     *
     * @param   string  $cityName
     * @return  array
     */
    public function getName($cityName)
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call all() method first.");
        }

        $cityName = ($this->currentLang == 'E') ? strtoupper($cityName): $cityName;

        $key = array_search($cityName, array_column($this->response['Cities'], 'Name'));

        return $this->response['Cities'][$key];
    }

    /**
     * Returns a certian city from a region by name.
     *
     * @param   string  $cityName
     * @return  array
     */
    public function byName($cityName)
    {
        return $this->getName($cityName);
    }

    /**
     * Returns a certian city from a region by name.
     *
     * @param   string  $cityName
     * @return  array
     */
    public function named($cityName)
    {
        return $this->getName($cityName);
    }

    /**
     * Returns a certian city from a region by name.
     *
     * @param   string  $cityName
     * @return  array
     */
    public function cityName($cityName)
    {
        return $this->getName($cityName);
    }

    /**
     * Returns all cities from a region by governorate name.
     *
     * @param   string  $govName
     * @return  array
     */
    public function getGov($govName)
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call all() method first.");
        }

        $govName = ($this->currentLang == 'E') ? $this->prepareGovernorateName($govName) : $govName;

        $keys = array_keys(array_combine(array_keys($this->response['Cities']), array_column($this->response['Cities'], 'GovernorateName')), $govName);

        foreach ($keys as $key) {
            $findings []= $this->response['Cities'][$key];
        }

        return $findings;
    }

    /**
     * Returns a certian city from a region by governorate name.
     *
     * @param   string  $govName
     * @return  array
     */
    public function byGovernorate($govName)
    {
        return $this->getGov($govName);
    }

    /**
     * Returns a certian city from a region by governorate name.
     *
     * @param   string  $govName
     * @return  array
     */
    public function byGov($govName)
    {
        return $this->getGov($govName);
    }

    /**
     * Returns a certian city from a region by governorate name.
     *
     * @param   string  $govName
     * @return  array
     */
    public function governorateName($govName)
    {
        return $this->getGov($govName);
    }

    /**
     * Returns a certian city from a region by governorate name.
     *
     * @param   string  $govName
     * @return  array
     */
    public function govName($govName)
    {
        return $this->getGov($govName);
    }

    /**
     * Returns a governorate name according to the API's dataset.
     *
     * @param   string  $governorateName
     * @return  string
     */
    protected function prepareGovernorateName($governorateName)
    {
        $words = explode(' ', $governorateName);
        if(($words[count($words)-1] != 'Principality') && ($words[count($words) - 1] != 'principality')){
            $correctName = '';
            foreach ($words as $word) {
                $word = str_replace(' ', '', $word);
                $correctName .= ($word == null) ? '': $word . ' ';
            }
            $correctName .= 'principality';
            $governorateName = $correctName;
        }

        return ucwords($governorateName);
    }
}
