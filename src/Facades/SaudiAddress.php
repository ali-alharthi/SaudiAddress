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

namespace AliAlharthi\SaudiAddress\Facades;

use Illuminate\Support\Facades\Facade;

class SaudiAddress extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'saudiaddress';
    }
}
