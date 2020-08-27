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

class RegionsTest extends FunctionalTestCase
{

    /** @test */
    public function it_can_retrieve_all_regions()
    {
        $request = $this->saudi->regions()->all('E');
        $this->assertInstanceOf('AliAlharthi\\SaudiAddress\\Api\\Regions', $request);
        $this->assertNotEmpty($request->get());
        $this->assertIsArray($request->get());
    }

    /** @test */
    public function it_can_retrieve_a_region_by_id()
    {
        $region = $this->saudi->regions()->all('E')->getId(2);
        $this->assertNotEmpty($region);
        $this->assertIsArray($region);
    }

    /** @test */
    public function it_can_retrieve_a_region_by_name()
    {
        $region = $this->saudi->regions()->all('E')->getName('Dammam');
        $this->assertNotEmpty($region);
        $this->assertIsArray($region);
    }

    /** @test */
    public function it_throws_an_exception_when_the_all_method_is_not_called_before_getId()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call all() method first.');
        $this->saudi->regions()->getId(2);
    }

    /** @test */
    public function it_throws_an_exception_when_the_all_method_is_not_called_before_getName()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call all() method first.');
        $this->saudi->regions()->getName('Dammam');
    }
}
