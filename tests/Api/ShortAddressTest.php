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

namespace AliAlharthi\SaudiAddress\Tests\Api;

use AliAlharthi\SaudiAddress\Tests\FunctionalTestCase;

class ShortAddressTest extends FunctionalTestCase
{

    /** @test */
    public function it_throws_an_exception_if_incorrect_short_address_is_provided()
    {
        $this->expectException(\AliAlharthi\SaudiAddress\Exception\SaudiAddressException::class);
        $this->expectExceptionMessage('Incorrect short address format: should consists of 4 letters followed by 4 numbers.');
        $this->saudi->shortAddress('738yfh');
    }

    /** @test */
    public function it_can_retrieve_an_address_from_a_short_address()
    {
        sleep(5); // For development subscription
        $address = $this->saudi->shortAddress('ECAB2823')->fullAddress();
        $this->assertNotEmpty($address);
        $this->assertIsArray($address);
    }

    /** @test */
    public function it_can_retrieve_geo_location_from_a_short_address()
    {
        sleep(5); // For development subscription
        $address = $this->saudi->shortAddress('ECAB2823')->geo();
        $this->assertNotEmpty($address);
        $this->assertIsArray($address);
    }

    /** @test */
    public function it_can_verify_short_address()
    {
        sleep(5); // For development subscription
        $this->assertTrue($this->saudi->shortAddress('ECAB2823')->verify());
        sleep(5); // For development subscription
        $this->assertFalse($this->saudi->shortAddress('RAHA3443')->verify());
    }
}
