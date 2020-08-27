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

namespace AliAlharthi\SaudiAddress\Api;

class Geo extends Api
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
    protected $file = __DIR__ . '/cache/' . 'geo_';

    /**
     * Address reverse geo.
     *
     * @param   string  $latitude
     * @param   string  $longitude
     * @param   string  $lang
     * @return  Geo
     */
    public function coordinates($latitude, $longitude, $lang = 'A')
    {
        $cache = $this->file . $latitude . '_' . $longitude . '_' . strtolower($lang) . '.data';
        if ($this->config->getCache() && file_exists($cache)) {
            $this->response = unserialize(file_get_contents($cache));
        }

        if ($this->response == null) {
            $response = $this->_get(
                'v3.1/Address/address-geocode',
                $lang,
                [
                    'lat'   => $latitude,
                    'long'  => $longitude
                ]
            );

            if($this->config->getCache()){
                (!file_exists($this->cacheDir)) ?
                mkdir($this->cacheDir, 0755, false):
                ((file_exists($cache)) ? unlink($cache):touch($cache));
                file_put_contents($cache, serialize($response['Addresses'][0]));
            }
            $this->response = $response['Addresses'][0];
        }

        return $this;
    }

    /**
     * Address reverse geo.
     *
     * @param   string  $latitude
     * @param   string  $longitude
     * @param   string  $lang
     * @return  array
     */
    public function coords($latitude, $longitude, $lang = 'A')
    {
        return $this->coordinates($latitude, $longitude, $lang);
    }

    /**
     * Address reverse geo.
     *
     * @param   string  $latitude
     * @param   string  $longitude
     * @param   string  $lang
     * @return  array
     */
    public function location($latitude, $longitude, $lang = 'A')
    {
        return $this->coordinates($latitude, $longitude, $lang);
    }

    /**
     * Returns a the response.
     *
     * @return  array
     */
    public function get()
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call coordinates() method first.");
        }

        return $this->response;
    }

    /**
     * Returns a the city name of reversed address.
     *
     * @return  array
     */
    public function getCity()
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call coordinates() method first.");
        }

        return $this->response['City'];
    }

    /**
     * Returns a the city name of reversed address.
     *
     * @return  array
     */
    public function city()
    {
        return $this->getCity();
    }

    /**
     * Returns a the address 1 of reversed address.
     *
     * @return  array
     */
    public function getAddressOne()
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call coordinates() method first.");
        }

        return $this->response['Address1'];
    }

    /**
     * Returns a the address 1 of reversed address.
     *
     * @return  array
     */
    public function addressOne()
    {
        return $this->getAddressOne();
    }

    /**
     * Returns a the address 2 of reversed address.
     *
     * @return  array
     */
    public function getAddressTwo()
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call coordinates() method first.");
        }

        return $this->response['Address2'];
    }

    /**
     * Returns a the address 2 of reversed address.
     *
     * @return  array
     */
    public function addressTwo()
    {
        return $this->getAddressTwo();
    }

    /**
     * Returns a the street name of reversed address.
     *
     * @return  array
     */
    public function getStreet()
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call coordinates() method first.");
        }

        return $this->response['Street'];
    }

    /**
     * Returns a the street name of reversed address.
     *
     * @return  array
     */
    public function street()
    {
        return $this->getStreet();
    }

    /**
     * Returns a the region name of reversed address.
     *
     * @return  array
     */
    public function getRegion()
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call coordinates() method first.");
        }

        return $this->response['RegionName'];
    }

    /**
     * Returns a the region name of reversed address.
     *
     * @return  array
     */
    public function region()
    {
        return $this->getRegion();
    }

    /**
     * Returns a the district name of reversed address.
     *
     * @return  array
     */
    public function getDistrict()
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call coordinates() method first.");
        }

        return $this->response['District'];
    }

    /**
     * Returns a the district name of reversed address.
     *
     * @return  array
     */
    public function district()
    {
        return $this->getDistrict();
    }

    /**
     * Returns a the building number name of reversed address.
     *
     * @return  array
     */
    public function getBuildingNumber()
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call coordinates() method first.");
        }

        return $this->response['BuildingNumber'];
    }

    /**
     * Returns a the building number name of reversed address.
     *
     * @return  array
     */
    public function buildingNumber()
    {
        return $this->getBuildingNumber();
    }

    /**
     * Returns a the post code name of reversed address.
     *
     * @return  array
     */
    public function getPostCode()
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call coordinates() method first.");
        }

        return $this->response['PostCode'];
    }

    /**
     * Returns a the post code name of reversed address.
     *
     * @return  array
     */
    public function postCode()
    {
        return $this->getPostCode();
    }

    /**
     * Returns a the post code name of reversed address.
     *
     * @return  array
     */
    public function getZip()
    {
        return $this->getPostCode();
    }

    /**
     * Returns a the post code name of reversed address.
     *
     * @return  array
     */
    public function zip()
    {
        return $this->getPostCode();
    }

    /**
     * Returns a the additional number name of reversed address.
     *
     * @return  array
     */
    public function getAdditionalNumber()
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call coordinates() method first.");
        }

        return $this->response['AdditionalNumber'];
    }

    /**
     * Returns a the additional number name of reversed address.
     *
     * @return  array
     */
    public function additionalNumber()
    {
        return $this->getAdditionalNumber();
    }

}
