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

class GeoTest extends FunctionalTestCase
{

    /** @test */
    public function it_can_retrieve_an_address_from_geo_coordinates()
    {
        $request = $this->saudi->geo()->coordinates(24.65017630, 46.71670870, 'E');
        $this->assertInstanceOf('AliAlharthi\\SaudiAddress\\Api\\Geo', $request);
        $this->assertNotEmpty($request->get());
        $this->assertIsArray($request->get());
    }

    /** @test */
    public function it_can_retrieve_a_city_from_geo_coordinates()
    {
        $city = $this->saudi->geo()->coordinates(24.65017630, 46.71670870, 'E')->getCity();
        $this->assertNotEmpty($city);
        $this->assertIsString($city);
    }

    /** @test */
    public function it_can_retrieve_an_address_one_from_geo_coordinates()
    {
        $addressOne = $this->saudi->geo()->coordinates(24.65017630, 46.71670870, 'E')->getAddressOne();
        $this->assertNotEmpty($addressOne);
        $this->assertIsString($addressOne);
    }

    /** @test */
    public function it_can_retrieve_an_address_two_from_geo_coordinates()
    {
        $addressTwo = $this->saudi->geo()->coordinates(24.65017630, 46.71670870, 'E')->getAddressTwo();
        $this->assertNotEmpty($addressTwo);
        $this->assertIsString($addressTwo);
    }

    /** @test */
    public function it_can_retrieve_a_street_name_from_geo_coordinates()
    {
        $street = $this->saudi->geo()->coordinates(24.65017630, 46.71670870, 'E')->getStreet();
        $this->assertNotEmpty($street);
        $this->assertIsString($street);
    }

    /** @test */
    public function it_can_retrieve_a_region_from_geo_coordinates()
    {
        $region = $this->saudi->geo()->coordinates(24.65017630, 46.71670870, 'E')->getRegion();
        $this->assertNotEmpty($region);
        $this->assertIsString($region);
    }

    /** @test */
    public function it_can_retrieve_a_district_from_geo_coordinates()
    {
        $district = $this->saudi->geo()->coordinates(24.65017630, 46.71670870, 'E')->getDistrict();
        $this->assertNotEmpty($district);
        $this->assertIsString($district);
    }

    /** @test */
    public function it_can_retrieve_a_building_number_from_geo_coordinates()
    {
        $buildingNumber = $this->saudi->geo()->coordinates(24.65017630, 46.71670870, 'E')->getBuildingNumber();
        $this->assertNotEmpty($buildingNumber);
        $this->assertIsString($buildingNumber);
    }

    /** @test */
    public function it_can_retrieve_a_post_code_from_geo_coordinates()
    {
        $postCode = $this->saudi->geo()->coordinates(24.65017630, 46.71670870, 'E')->getPostCode();
        $this->assertNotEmpty($postCode);
        $this->assertIsString($postCode);
    }

    /** @test */
    public function it_can_retrieve_an_additional_number_from_geo_coordinates()
    {
        $additionalNumber = $this->saudi->geo()->coordinates(24.65017630, 46.71670870, 'E')->getAdditionalNumber();
        $this->assertNotEmpty($additionalNumber);
        $this->assertIsString($additionalNumber);
    }

    /** @test */
    public function it_throws_an_exception_when_the_coordinates_method_is_not_called_before_getCity()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call coordinates() method first.');
        $this->saudi->geo()->getCity();
    }

    /** @test */
    public function it_throws_an_exception_when_the_coordinates_method_is_not_called_before_getAddressOne()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call coordinates() method first.');
        $this->saudi->geo()->getAddressOne();
    }

    /** @test */
    public function it_throws_an_exception_when_the_coordinates_method_is_not_called_before_getAddressTwo()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call coordinates() method first.');
        $this->saudi->geo()->getAddressTwo();
    }

    /** @test */
    public function it_throws_an_exception_when_the_coordinates_method_is_not_called_before_getStreet()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call coordinates() method first.');
        $this->saudi->geo()->getStreet();
    }

    /** @test */
    public function it_throws_an_exception_when_the_coordinates_method_is_not_called_before_getRegion()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call coordinates() method first.');
        $this->saudi->geo()->getRegion();
    }

    /** @test */
    public function it_throws_an_exception_when_the_coordinates_method_is_not_called_before_getDistrict()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call coordinates() method first.');
        $this->saudi->geo()->getDistrict();
    }

    /** @test */
    public function it_throws_an_exception_when_the_coordinates_method_is_not_called_before_getBuildingNumber()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call coordinates() method first.');
        $this->saudi->geo()->getBuildingNumber();
    }

    /** @test */
    public function it_throws_an_exception_when_the_coordinates_method_is_not_called_before_getPostCode()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call coordinates() method first.');
        $this->saudi->geo()->getPostCode();
    }

    /** @test */
    public function it_throws_an_exception_when_the_coordinates_method_is_not_called_before_getAdditionalNumber()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call coordinates() method first.');
        $this->saudi->geo()->getAdditionalNumber();
    }
}
