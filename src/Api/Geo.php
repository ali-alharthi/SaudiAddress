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

class Geo extends Api
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
    protected $file = __DIR__ . '/cache/' . 'geo_';

    /**
     * Constructor.
     *
     * @param   \AliAlharthi\SaudiAddress\ConfigInterface  $config
     * @param   string  $latitude
     * @param   string  $longitude
     */
    public function __construct($config, $latitude, $longitude)
    {

        parent::__construct($config);
        $cache = $this->file . $latitude . '_' . $longitude . '_' . strtolower($this->config->getLocale()) . '.data';

        $this->response = $this->cacheValue($cache);

        if ($this->response == null) {
            $response = $this->_get(
                'v3.1/Address/address-geocode',
                [
                    'lat'   => $latitude,
                    'long'  => $longitude
                ]
            );

            if($this->config->getCache()){
                (!file_exists($this->cacheDir)) ?
                mkdir($this->cacheDir, 0755, false):
                ((file_exists($cache)) ? unlink($cache):touch($cache));
                file_put_contents($cache, serialize($response));
            }
            $this->response = $response;
        }

    }


    /**
     * Returns a the response.
     *
     * @return  array
     */
    public function get()
    {
        return $this->response['Addresses'][0];
    }

    /**
     * Returns a the response.
     *
     * @return  array
     */
    public function all()
    {
        return $this->get();
    }

    /**
     * Returns a the city name of reversed address.
     *
     * @return  array
     */
    public function getCity()
    {
        return $this->response['Addresses'][0]['City'];
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
        return $this->response['Addresses'][0]['Address1'];
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
        return $this->response['Addresses'][0]['Address2'];
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
        return $this->response['Addresses'][0]['Street'];
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
        return $this->response['Addresses'][0]['RegionName'];
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
        return $this->response['Addresses'][0]['District'];
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
        return $this->response['Addresses'][0]['BuildingNumber'];
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
        return $this->response['Addresses'][0]['PostCode'];
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
        return $this->response['Addresses'][0]['AdditionalNumber'];
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
