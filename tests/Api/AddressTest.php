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

namespace AliAlharthi\SaudiAddress\Tests\Api;

use AliAlharthi\SaudiAddress\Tests\FunctionalTestCase;

class AddressTest extends FunctionalTestCase
{

    /** @test */
    public function it_can_retrieve_all_addresses_from_a_string()
    {
        $request = $this->saudi->address()->find('9935', 1, 'E');
        $this->assertInstanceOf('AliAlharthi\\SaudiAddress\\Api\\Address', $request);
        $this->assertNotEmpty($request->all());
        $this->assertIsArray($request->all());
    }

    /** @test */
    public function it_can_verify_an_address()
    {
        sleep(5); // For development subscription
        $this->assertTrue($this->saudi->address()->verify(8228, 12643, 2121, 'E'));
        sleep(5); // For development subscription
        $this->assertFalse($this->saudi->address()->verify(9999, 99999, 9999, 'E'));
    }

    /** @test */
    public function it_throws_an_exception_when_the_find_method_is_not_called_before_all()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call find() method first.');
        $this->saudi->address()->all();
    }
}
