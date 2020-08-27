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

namespace AliAlharthi\SaudiAddress\Tests\Api;

use AliAlharthi\SaudiAddress\Tests\FunctionalTestCase;

class DistrictsTest extends FunctionalTestCase
{

    /** @test */
    public function it_can_retrieve_all_districts()
    {
        $request = $this->saudi->districts()->all(13, 'E');
        $this->assertInstanceOf('AliAlharthi\\SaudiAddress\\Api\\Districts', $request);
        $this->assertNotEmpty($request->get());
        $this->assertIsArray($request->get());
    }

    /** @test */
    public function it_can_retrieve_a_district_by_id()
    {
        $region = $this->saudi->districts()->all(13, 'E')->getId(2);
        $this->assertNotEmpty($region);
        $this->assertIsArray($region);
    }

    /** @test */
    public function it_can_retrieve_a_district_by_name()
    {
        $region = $this->saudi->districts()->all(13, 'E')->getName('Dammam');
        $this->assertNotEmpty($region);
        $this->assertIsArray($region);
    }


    /** @test */
    public function it_throws_an_exception_when_the_all_method_is_not_called_before_getId()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call all() method first.');
        $this->saudi->districts()->getId(2);
    }

    /** @test */
    public function it_throws_an_exception_when_the_all_method_is_not_called_before_getName()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call all() method first.');
        $this->saudi->districts()->getName('District');
    }
}
