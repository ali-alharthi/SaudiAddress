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

class ApiLimitExceededException extends SaudiAddressException
{
    /**
     * Constructor.
     *
     * @throws  \AliAlharthi\SaudiAddress\Exception\SaudiAddressException
     */
    public function __construct()
    {
        parent::__construct('You have reached the rate limit of your Saudi National Address subscription!');
    }
}
