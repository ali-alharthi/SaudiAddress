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

class CitiesTest extends FunctionalTestCase
{

    /** @test */
    public function it_can_retrieve_all_cities()
    {
        $request = $this->saudi->cities()->all(-1, 'E');
        $this->assertInstanceOf('AliAlharthi\\SaudiAddress\\Api\\Cities', $request);
        $this->assertNotEmpty($request->get());
        $this->assertIsArray($request->get());
    }

    /** @test */
    public function it_can_retrieve_a_city_by_id()
    {
        $city = $this->saudi->cities()->all(-1, 'E')->getId(2);
        $this->assertNotEmpty($city);
        $this->assertIsArray($city);
    }

    /** @test */
    public function it_can_retrieve_a_city_by_name()
    {
        $city = $this->saudi->cities()->all(-1, 'E')->getName('Dammam');
        $this->assertNotEmpty($city);
        $this->assertIsArray($city);
    }

    /** @test */
    public function it_can_retrieve_a_cities_by_governorate_name()
    {
        $cities = $this->saudi->cities()->all(-1, 'E')->getGov('Eastern Province Principality');
        $this->assertNotEmpty($cities);
        $this->assertIsArray($cities);
    }

    /** @test */
    public function it_can_prepare_governorate_name_correctly()
    {
        $cities = $this->saudi->cities()->all(-1, 'E')->getGov('eastern province '); // With space and lower case
        $this->assertNotEmpty($cities);
        $this->assertIsArray($cities);

        $cities = $this->saudi->cities()->all(-1, 'E')->getGov('Eastern province'); // Without Space and lower case
        $this->assertNotEmpty($cities);
        $this->assertIsArray($cities);

        $cities = $this->saudi->cities()->all(-1, 'E')->getGov('Eastern Province Principality'); // Correct governorate name
        $this->assertNotEmpty($cities);
        $this->assertIsArray($cities);
    }

    /** @test */
    public function it_throws_an_exception_when_the_all_method_is_not_called_before_getId()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call all() method first.');
        $this->saudi->cities()->getId(2);
    }

    /** @test */
    public function it_throws_an_exception_when_the_all_method_is_not_called_before_getName()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call all() method first.');
        $this->saudi->cities()->getName('Dammam');
    }

    /** @test */
    public function it_throws_an_exception_when_the_all_method_is_not_called_before_getGov()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call all() method first.');
        $this->saudi->cities()->getGov('Eastern Province');
    }
}
