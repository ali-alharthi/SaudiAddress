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

class GeoTest extends FunctionalTestCase
{

    /** @test */
    public function it_can_retrieve_an_address_from_geo_coordinates()
    {
        $request = $this->saudi->geo(24.65017630, 46.71670870);
        $this->assertInstanceOf('AliAlharthi\\SaudiAddress\\Api\\Geo', $request);
        $this->assertNotEmpty($request->get());
        $this->assertIsArray($request->get());
    }

    /** @test */
    public function it_can_retrieve_a_city_from_geo_coordinates()
    {
        $city = $this->saudi->geo(24.65017630, 46.71670870)->getCity();
        $this->assertNotEmpty($city);
        $this->assertIsString($city);
    }

    /** @test */
    public function it_can_retrieve_an_address_one_from_geo_coordinates()
    {
        $addressOne = $this->saudi->geo(24.65017630, 46.71670870)->getAddressOne();
        $this->assertNotEmpty($addressOne);
        $this->assertIsString($addressOne);
    }

    /** @test */
    public function it_can_retrieve_an_address_two_from_geo_coordinates()
    {
        $addressTwo = $this->saudi->geo(24.65017630, 46.71670870)->getAddressTwo();
        $this->assertNotEmpty($addressTwo);
        $this->assertIsString($addressTwo);
    }

    /** @test */
    public function it_can_retrieve_a_street_name_from_geo_coordinates()
    {
        $street = $this->saudi->geo(24.65017630, 46.71670870)->getStreet();
        $this->assertNotEmpty($street);
        $this->assertIsString($street);
    }

    /** @test */
    public function it_can_retrieve_a_region_from_geo_coordinates()
    {
        $region = $this->saudi->geo(24.65017630, 46.71670870)->getRegion();
        $this->assertNotEmpty($region);
        $this->assertIsString($region);
    }

    /** @test */
    public function it_can_retrieve_a_district_from_geo_coordinates()
    {
        $district = $this->saudi->geo(24.65017630, 46.71670870)->getDistrict();
        $this->assertNotEmpty($district);
        $this->assertIsString($district);
    }

    /** @test */
    public function it_can_retrieve_a_building_number_from_geo_coordinates()
    {
        $buildingNumber = $this->saudi->geo(24.65017630, 46.71670870)->getBuildingNumber();
        $this->assertNotEmpty($buildingNumber);
        $this->assertIsString($buildingNumber);
    }

    /** @test */
    public function it_can_retrieve_a_post_code_from_geo_coordinates()
    {
        $postCode = $this->saudi->geo(24.65017630, 46.71670870)->getPostCode();
        $this->assertNotEmpty($postCode);
        $this->assertIsString($postCode);
    }

    /** @test */
    public function it_can_retrieve_an_additional_number_from_geo_coordinates()
    {
        $additionalNumber = $this->saudi->geo(24.65017630, 46.71670870)->getAdditionalNumber();
        $this->assertNotEmpty($additionalNumber);
        $this->assertIsString($additionalNumber);
    }

}
