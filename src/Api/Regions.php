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

class Regions extends Api
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
    protected $file = __DIR__ . '/cache/' . 'regions_';

    /**
     * Returns a list of all the regions.
     *
     * @param   string  $lang
     * @return  Regions
     */
    public function all($lang = 'A')
    {
        $cache = $this->file . strtolower($lang) . '.data';

        $this->response = $this->cacheValue($cache);

        if ($this->response == null) {
            $response = $this->_get(
                'v3.1/lookup/regions',
                $lang
            );
            if($this->config->getCache()){
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
        $this->check();

        return $this->response['Regions'];
    }

    /**
     * Returns a certian region info by id.
     *
     * @param   int     $regionId
     * @return  array
     */
    public function getId(int $regionId)
    {
        $this->check();

        $key = array_search($regionId, array_column($this->response['Regions'], 'Id'));

        return $this->response['Regions'][$key];
    }

    /**
     * Returns a certian region info by id.
     *
     * @param   int     $regionId
     * @return  array
     */
    public function byId(int $regionId)
    {
        return $this->getId($regionId);
    }

    /**
     * Returns a certian region info by id.
     *
     * @param   int     $regionId
     * @return  array
     */
    public function id(int $regionId)
    {
        return $this->getId($regionId);
    }

    /**
     * Returns a certian region info by name.
     *
     * @param   string  $name
     * @return  array
     */
    public function getName($name)
    {
        $this->check();

        $key = array_search(ucwords($name), array_column($this->response['Regions'], 'Name'));

        return $this->response['Regions'][$key];
    }

    /**
     * Returns a certian region info by name.
     *
     * @param   string  $name
     * @return  array
     */
    public function name($name)
    {
        return $this->getName($name);
    }

    /**
     * Returns a certian region info by name.
     *
     * @param   string  $name
     * @return  array
     */
    public function byName($name)
    {
        return $this->getName($name);
    }

    /**
     * Returns a certian region info by name.
     *
     * @param   string  $name
     * @return  array
     */
    public function named($name)
    {
        return $this->getName($name);
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
            throw new \BadMethodCallException("You need to call all() method first.");
        }
    }
}
