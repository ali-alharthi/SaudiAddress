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

namespace AliAlharthi\SaudiAddress\Tests;

use AliAlharthi\SaudiAddress\SaudiAddress;

class SaudiAddressTest extends \PHPUnit\Framework\TestCase
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

    /** @test */
    public function it_can_create_a_new_instance_using_the_make_method()
    {
        $saudi = SaudiAddress::make('sna-api-key');
        $this->assertEquals('sna-api-key', $saudi->getApiKey());
    }

    /** @test */
    public function it_can_create_a_new_instance_using_enviroment_variables()
    {
        $saudi = new SaudiAddress;
        $this->assertEquals(getenv('SNA_API_KEY'), $saudi->getApiKey());

    }

    /** @test */
    public function it_can_get_and_set_the_api_key()
    {
        $this->saudi->setApiKey('new-sna-api-key');
        $this->assertEquals('new-sna-api-key', $this->saudi->getApiKey());
    }

    /** @test */
    public function it_can_get_the_current_package_version()
    {
        $version = $this->saudi->getVersion();
        $this->assertSame(2.0, $version);
    }

    /** @test */
    public function it_can_get_the_current_locale()
    {
        $locale = $this->saudi->getLocale();
        $this->assertSame('E', $locale);
    }

    /** @test */
    public function it_can_create_requests()
    {
        $request = $this->saudi->regions()->all('E');
        $this->assertInstanceOf('AliAlharthi\\SaudiAddress\\Api\\Regions', $request);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_when_the_request_is_invalid()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->saudi->foo();
    }

    /**
     * @test
     */
    public function it_throws_an_exception_when_the_api_key_is_not_set()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('The Saudi National Address API key is not defined.');
        unset($_SERVER['SNA_API_KEY']);
        putenv('SNA_API_KEY');
        $saudi = new SaudiAddress();
        // to skip the cache
        $saudi->regions();
    }
}
