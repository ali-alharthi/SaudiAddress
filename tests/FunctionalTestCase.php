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

namespace AliAlharthi\SaudiAddress\Tests;

use Mockery as m;
use AliAlharthi\SaudiAddress\SaudiAddress;

class FunctionalTestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * The SaudiAddress API client instance.
     *
     * @var \AliAlharthi\SaudiAddress\SaudiAddress
     */
    protected $saudi;

    /**
     * Setup resources and dependencies
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->saudi = new SaudiAddress('sna-api-key', 'Development');
    }
}
