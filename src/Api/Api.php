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
use AliAlharthi\SaudiAddress\Exception\Handler;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

abstract class Api implements ApiInterface
{
    const API_BASE_URL = 'https://apina.address.gov.sa/NationalAddress/';
    const USER_AGENT_SUFFIX = "alharthi-saudi-address-api-php-client/";
    const IN_CHARACTER_ENCODING = 'windows-1256';
    const OUT_CHARACTER_ENCODING = 'UTF-8';

    /**
     * The Config repository instance.
     *
     * @var \AliAlharthi\SaudiAddress\ConfigInterface
     */
    protected $config;

    /**
     * Constructor.
     *
     * @param   \AliAlharthi\SaudiAddress\ConfigInterface  $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * Set the config.
     *
     * @param   \AliAlharthi\SaudiAddress\ConfigInterface  $config
     * @return  void
     */
    public function setConfig(ConfigInterface $config){
        $this->config = $config;
    }

    /**
     * Returns the Saudi National Address API endpoint.
     *
     * @return  string
     */
    public function baseUrl()
    {
        return self::API_BASE_URL;
    }

    /**
     * Execute a get request.
     *
     * @param   string  $url
     * @param   array   $parameters
     * @param   bool    $encode
     * @return  null|array
     */
    public function _get($url = null, $parameters = [], $encode = true)
    {
        return $this->execute('get', $url, $parameters, $encode);
    }

    /**
     * Execute a request.
     *
     * @param   string  $httpMethod
     * @param   string  $url
     * @param   array   $parameters
     * @param   bool    $encode
     * @return  null|array
     * @throws  AliAlharthi\SaudiAddress\Exception\Handler
     */
    public function execute($httpMethod, $url, $parameters = [], $encode = true)
    {
        try {
            $parameters['format'] = 'json';
            $parameters['language'] = $this->config->getLocale();
            $parameters = http_build_query($parameters);
            $response = $this->getClient()->{$httpMethod}($url, ['query' => $parameters]);

            return ($encode) ?
                json_decode(iconv(self::IN_CHARACTER_ENCODING, self::OUT_CHARACTER_ENCODING, ($response->getBody())), true) :
                json_decode($response->getBody(), true);

        } catch (ClientException $e) {
            new Handler($e);
        }
    }

    /**
     * Returns an Http client instance.
     *
     * @return  \GuzzleHttp\Client
     */
    protected function getClient()
    {
        return new Client([
            'base_uri' => $this->baseUrl(), 'handler' => $this->createHandler()
        ]);
    }

    /**
     * Create the client handler.
     *
     * @return  \GuzzleHttp\HandlerStack
     * @throws  \RuntimeException
     */
    protected function createHandler()
    {
        if (! $this->config->getApiKey()) {
            throw new RuntimeException('The Saudi National Address API key is not defined.');
        }

        $stack = HandlerStack::create();

        $stack->push(Middleware::mapRequest(function (RequestInterface $request) {
            $config = $this->config;

            $request = $request->withHeader('api_key', $config->getApiKey());

            $request = $request->withHeader('User-Agent', $this->generateUserAgent());

            $request = $request->withHeader('accept', 'application/json');

            return $request;
        }));

        $stack->push(Middleware::retry(function ($retries, RequestInterface $request, ResponseInterface $response = null, TransferException $exception = null) {
            return $retries < 3 && ($exception instanceof ConnectException || ($response && $response->getStatusCode() >= 500));
        }, function ($retries) {
            return (int) pow(2, $retries) * 1000;
        }));

        return $stack;
    }

    /**
     * Generates the main user agent string.
     *
     * @return  string
     */
    protected function generateUserAgent()
    {
        return self::USER_AGENT_SUFFIX . $this->config->getVersion();
    }

    /**
     * Return a value from cache.
     *
     * @param   string  $file
     * @return  array|null
     */
    protected function cacheValue($file)
    {
        if ($this->config->getCache() && file_exists($file)) {
            return unserialize(file_get_contents($file));
        }

        return null;
    }
}
