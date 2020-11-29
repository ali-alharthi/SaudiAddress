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

class ServicesTest extends FunctionalTestCase
{

    /** @test */
    public function it_can_retrieve_all_services()
    {
        $services = $this->saudi->services()->categories('E');
        $this->assertInstanceOf('AliAlharthi\\SaudiAddress\\Api\\Services', $services);
        $this->assertNotEmpty($services->get());
        $this->assertIsArray($services->get());
    }

    public function it_can_retrieve_all_sub_services()
    {
        $subservices = $this->saudi->services()->sub(102, 'E');
        $this->assertInstanceOf('AliAlharthi\\SaudiAddress\\Api\\Services', $subservices);
        $this->assertNotEmpty($subservices->get());
        $this->assertIsArray($subservices->get());
    }

    /** @test */
    public function it_can_retrieve_a_service_by_id()
    {
        $service = $this->saudi->services()->categories('E')->getId(1);
        $this->assertNotEmpty($service);
        $this->assertIsArray($service);

    }

    /** @test */
    public function it_can_retrieve_a_service_by_name()
    {
        $service = $this->saudi->services()->categories('E')->getName('Restaurant');
        $this->assertNotEmpty($service);
        $this->assertIsArray($service);

    }

    /** @test */
    public function it_can_retrieve_a_sub_service_by_id()
    {
        $subservice = $this->saudi->services()->sub(120, 'E')->sub(102, 'E')->getId(1);
        $this->assertNotEmpty($subservice);
        $this->assertIsArray($subservice);

    }

    /** @test */
    public function it_can_retrieve_a_sub_service_by_name()
    {
        $subservice = $this->saudi->services()->sub(120, 'E')->sub(102, 'E')->getName('Supermarket');
        $this->assertNotEmpty($subservice);
        $this->assertIsArray($subservice);

    }

    /** @test */
    public function it_throws_an_exception_when_the_categories_or_sub_methods_are_not_called_before_get()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('You need to call categories() or sub() methods first.');
        $this->saudi->services()->get();
    }
}
