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

namespace AliAlharthi\SaudiAddress\Exception;

use GuzzleHttp\Exception\ClientException;

class Handler
{
    /**
     * List of mapped exceptions and their corresponding status codes.
     *
     * @var array
     */
    protected $exceptionsByStatusCode = [

        // Often missing a required parameter
        400 => 'BadRequest',

        // Invalid Saudi National Address API key provided
        401 => 'Unauthorized',

        // Invalid Saudi National Address API key provided
        401 => 'Unauthorized',

        // Reached Saudi National Address API account rate limit
        403 => 'ApiLimitExceeded',

        // Parameters were valid but request failed
        402 => 'InvalidRequest',

        // The requested item doesn't exist
        404 => 'NotFound',

        // Something went wrong on Saudi National Address's end
        500 => 'ServerError',
        502 => 'ServerError',
        503 => 'ServerError',
        504 => 'ServerError',

    ];

    /**
     * Constructor.
     *
     * @param   \GuzzleHttp\Exception\ClientException  $exception
     * @throws  \AliAlharthi\SaudiAddress\Exception\SaudiAddressException
     */
    public function __construct(ClientException $exception)
    {
        $response = $exception->getResponse();

        $headers = $response->getHeaders();

        $statusCode = $response->getStatusCode();

        $rawOutput = json_decode($response->getBody(true), true);

        $error = isset($rawOutput['error']) ? $rawOutput['error'] : [];

        $errorCode = isset($error['code']) ? $error['code'] : null;

        $errorType = isset($error['type']) ? $error['type'] : null;

        $message = isset($error['message']) ? $error['message'] : null;

        $missingParameter = isset($error['param']) ? $error['param'] : null;

        $this->handleException(
            $message,
            $headers,
            $statusCode,
            $errorType,
            $errorCode,
            $missingParameter,
            $rawOutput
        );
    }

    /**
     * Guesses the FQN of the exception to be thrown.
     *
     * @param   string  $message
     * @param   int     $statusCode
     * @param   string  $errorType
     * @param   string  $errorCode
     * @param   string  $missingParameter
     * @return  void
     * @throws  \AliAlharthi\SaudiAddress\Exception\SaudiAddressException
     */
    protected function handleException($message, $headers, $statusCode, $errorType, $errorCode, $missingParameter, $rawOutput)
    {
        if ($statusCode === 400 && $errorCode === 'rate_limit') {
            $class = 'ApiLimitExceeded';
        } elseif ($statusCode === 400 && $errorType === 'invalid_request_error') {
            $class = 'MissingParameter';
        } elseif (array_key_exists($statusCode, $this->exceptionsByStatusCode)) {
            $class = $this->exceptionsByStatusCode[$statusCode];
        } else {
            $class = 'SaudiAddress';
        }

        $class = "\\AliAlharthi\\SaudiAddress\\Exception\\{$class}Exception";

        $instance = new $class($message, $statusCode);

        $instance->setHeaders($headers);
        $instance->setErrorCode($errorCode);
        $instance->setErrorType($errorType);
        $instance->setMissingParameter($missingParameter);
        $instance->setRawOutput($rawOutput);

        throw $instance;
    }
}
