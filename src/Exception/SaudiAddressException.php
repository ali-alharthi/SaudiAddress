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

namespace AliAlharthi\SaudiAddress\Exception;

class SaudiAddressException extends \Exception
{
    /**
     * The response headers sent by Saudi National Address.
     *
     * @var array
     */
    protected $headers = [];

    /**
     * The error code returned by Saudi National Address.
     *
     * @var string
     */
    protected $errorCode;

    /**
     * The error type returned by Saudi National Address.
     *
     * @var string
     */
    protected $errorType;

    /**
     * The missing parameter returned by Saudi National Address  with the error.
     *
     * @var string
     */
    protected $missingParameter;

    /**
     * The raw output returned by Saudi National Address in case of exception.
     *
     * @var string
     */
    protected $rawOutput;

    /**
     * Returns the response headers sent by Saudi National Address.
     *
     * @return  array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Sets the response headers sent by Saudi National Address.
     *
     * @param   array   $headers
     * @return  $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Returns the error type returned by Saudi National Address.
     *
     * @return  string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * Sets the error type returned by Saudi National Address.
     *
     * @param   string  $errorCode
     * @return  $this
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * Returns the error type returned by Saudi National Address.
     *
     * @return  string
     */
    public function getErrorType()
    {
        return $this->errorType;
    }

    /**
     * Sets the error type returned by Saudi National Address.
     *
     * @param   string  $errorType
     * @return  $this
     */
    public function setErrorType($errorType)
    {
        $this->errorType = $errorType;

        return $this;
    }

    /**
     * Returns missing parameter returned by Saudi National Address with the error.
     *
     * @return  string
     */
    public function getMissingParameter()
    {
        return $this->missingParameter;
    }

    /**
     * Sets the missing parameter returned by Saudi National Address with the error.
     *
     * @param   string  $missingParameter
     * @return  $this
     */
    public function setMissingParameter($missingParameter)
    {
        $this->missingParameter = $missingParameter;

        return $this;
    }

    /**
     * Returns raw output returned by Saudi National Address in case of exception.
     *
     * @return  string
     */
    public function getRawOutput()
    {
        return $this->rawOutput;
    }

    /**
     * Sets the raw output parameter returned by Saudi National Address in case of exception.
     *
     * @param   string  $rawOutput
     * @return  $this
     */
    public function setRawOutput($rawOutput)
    {
        $this->rawOutput = $rawOutput;

        return $this;
    }
}
