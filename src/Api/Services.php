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

class Services extends Api
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
    protected $file = __DIR__ . '/cache/' . 'services_';

    /**
     * Returns a list of all the services categories.
     *
     * @param   string  $lang
     * @return  Services
     */
    public function categories($lang = 'A')
    {

        $cache = $this->file . 'categories_' . strtolower($lang) . '.data';

        $this->response = $this->cacheValue($cache);

        if ($this->response == null) {
            $response = $this->_get(
                'v3.1/lookup/service-categories',
                $lang
            );
            if($response['success'] == false){
                return ;
            }
            if($this->config->getCache()){
                (!file_exists($this->cacheDir)) ?
                    mkdir($this->cacheDir, 0777, false) : ((file_exists($cache)) ? unlink($cache) : touch($cache));
                file_put_contents($cache, serialize($response['ServiceCategories']));
            }
            $this->response = $response['ServiceCategories'];
        }

        return $this;
    }

    /**
     * Returns a list of all the services categories.
     *
     * @param   string  $lang
     * @return  array
     */
    public function main($lang = 'A')
    {
        return $this->categories($lang);
    }

    /**
     * Returns a list of all the services categories.
     *
     * @param   string  $lang
     * @return  array
     */
    public function cat($lang = 'A')
    {
        return $this->categories($lang);
    }

    /**
     * Returns a list of all the sub services of a service.
     *
     * @param   int     $serviceId
     * @param   string  $lang
     * @return  Services
     */
    public function sub(int $serviceId = 1, $lang = 'A')
    {
        $cache = $this->file . 'sub_' . $serviceId . '_' . strtolower($lang) . '.data';

        $this->response = $this->cacheValue($cache);

        if ($this->config->getCache() && $this->response == null) {
            $response = $this->_get(
                'v3.1/lookup/services-sub-categories',
                $lang,
                [
                    'servicecategoryid' => $serviceId
                ]
            );
            if ($response['success'] == false) {
                return;
            }
            if($this->config->getCache()){
                (!file_exists($this->cacheDir)) ?
                    mkdir($this->cacheDir, 0777, false) : ((file_exists($cache)) ? unlink($cache) : touch($cache));
                file_put_contents($cache, serialize($response['ServiceSubCategories']));
            }
            $this->response = $response['ServiceSubCategories'];
        }

        return $this;
    }

    /**
     * Returns a list of all the sub services of a service.
     *
     * @param   int     $serviceId
     * @param   string  $lang
     * @return  array
     */
    public function subCategories(int $serviceId = 1, $lang = 'A')
    {
        $this->sub($serviceId, $lang);
    }

    /**
     * Returns a list of all the sub services of a service.
     *
     * @param   int     $serviceId
     * @param   string  $lang
     * @return  array
     */
    public function subServices(int $serviceId = 1, $lang = 'A')
    {
        $this->sub($serviceId, $lang);
    }

    /**
     * Returns a the response.
     *
     * @return  array
     */
    public function get()
    {
        $this->check();

        return $this->response;
    }

    /**
     * Returns a specific service by id.
     *
     * @param   int     $serviceId
     * @return  array
     */
    public function getId(int $serviceId)
    {
        $this->check();

        $key = array_search($serviceId, array_column($this->response, 'Id'));

        return $this->response[$key];
    }

    /**
     * Returns a specific service by id.
     *
     * @param   int     $serviceId
     * @return  array
     */
    public function byId(int $serviceId)
    {
        return $this->getId($serviceId);
    }

    /**
     * Returns a specific service by id.
     *
     * @param   int     $serviceId
     * @return  array
     */
    public function id(int $serviceId)
    {
        return $this->getId($serviceId);
    }

    /**
     * Returns a specific service by name.
     *
     * @param   string  $serviceName
     * @return  array
     */
    public function getName($serviceName)
    {
        $this->check();

        $key = array_search($serviceName, array_column($this->response, 'Name'));

        return $this->response[$key];
    }

    /**
     * Returns a specific service by name.
     *
     * @param   string  $serviceName
     * @return  array
     */
    public function byName($serviceName)
    {
        return $this->getName($serviceName);
    }

    /**
     * Returns a specific service by name.
     *
     * @param   string  $serviceName
     * @return  array
     */
    public function named($serviceName)
    {
        return $this->getName($serviceName);
    }

    /**
     * Returns a specific service by name.
     *
     * @param   string  $serviceName
     * @return  array
     */
    public function serviceName($serviceName)
    {
        return $this->getName($serviceName);
    }

    /**
     * Check if all() method was called first.
     *
     * @return  void
     * @throws  \BadMethodCallException
     */
    protected function check()
    {
        if ($this->response == null) {
            throw new \BadMethodCallException("You need to call categories() or sub() methods first.");
        }
    }
}
