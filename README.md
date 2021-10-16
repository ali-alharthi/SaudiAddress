# Saudi National Address API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ali-alharthi/saudiaddress.svg?style=flat)](https://packagist.org/packages/ali-alharthi/saudiaddress)
[![Build Status](https://img.shields.io/scrutinizer/build/g/ali-alharthi/SaudiAddress/master?style=flat)](https://scrutinizer-ci.com/g/ali-alharthi/SaudiAddress/build-status/master)
[![Quality Score](https://img.shields.io/scrutinizer/g/ali-alharthi/saudiaddress.svg?style=flat)](https://scrutinizer-ci.com/g/ali-alharthi/saudiaddress)
[![Total Downloads](https://img.shields.io/packagist/dt/ali-alharthi/saudiaddress.svg?style=flat)](https://packagist.org/packages/ali-alharthi/saudiaddress)

SaudiAddress is a PHP package/library built to consume the Saudi National Address API ([api.address.gov.sa](api.address.gov.sa)). It makes it simple to use most of what the API has to offer.

You can for example retrieve regions, cities, districts, services and addresses from geo coordinates, verify an address and more!


## Installation

You can install the package via composer:

```bash
composer require ali-alharthi/saudiaddress
```

## Laravel

This package supports **Laravel** out of the box :smile:.

However, you need to add the following to the `config/services.php` file:

```php
'saudiaddress' => [
    'api_key' => env('SNA_API_KEY', null),
    'api_subscription' =>
    env('SNA_API_SUBSCRIPTION', 'Development'),
    'locale' => env('SNA_CACHE', 'E'),
    'cache' => env('SNA_CACHE', true),
],
```

Then, append the following to the `.env` file:

```php
SNA_API_KEY=YOUR-API-KEY-HERE
SNA_API_SUBSCRIPTION=Development
SNA_LOCALE=E
SNA_CACHE=false
```

```
SNA_API_KEY             =>  SNA API key
SNA_API_SUBSCRIPTION    =>  SNA subscription type
SNA_LOCALE              =>  Language (E for English and A for Arabic)
SNA_CACHE               =>  true or false (enable/disable cache).
```

After that you can use the facade: `AliAlharthi\SaudiAddress\Facades\SaudiAddress` to access the library.

## Usage

### As a regualr PHP package:

``` php
use AliAlharthi\SaudiAddress\SaudiAddress;

$saudi = SaudiAddress::make('API-KEY', 'Subscription', 'E', false); // Cache is disabled
$verified = $saudi->shortAddress('ECAB2823')->verify();
```

### Laravel:

``` php
use AliAlharthi\SaudiAddress\Facades\SaudiAddress;

$verified = SaudiAddress::shortAddress('ECAB2823')->verify();
```



----


### :mag: Short Address :new:

- Get the full address using the Saudi short address:
    - parameter `short` is the "short address".

```php
$addresses = $saudi->shortAddress('short'); // return an array of address information
```

----

- Get the geo location from a short address:
    - parameter `short` is the "short address".

```php
$addresses = $saudi->shortAddress('short')->geo(); // return an array of long and lat information
```

----

- Verify a Short Address.
    - parameters `ECAB2823` and `RAHA3443` are the short addresses.

```php
$verified = $saudi->shortAddress('ECAB2823')->verify(); // return true
$verified = $saudi->shortAddress('RAHA3443')->verify(); // return false

```

***Short address should consists of 4 letters followed by 4 numbers***
```Example: ABCD1234```

*An exception will be thrown if an incorrect short address was provided*


----


----


### :round_pushpin: GEO

- Address reverse (Get the address from geo coordinates):
    - parameter `24.65017630` is latitude and parameter `46.71670870` is longitude.


```php
$address = $saudi->geo(24.65017630, 46.71670870)->get();
```

`coordinates()` aliases:  `coords()` and `location()`.


- Get the city from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$city = $saudi->geo(24.65017630, 46.71670870)->getCity();
```

`getCity()` aliases:  `city()`.


- Get the address line 1 from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$addressOne = $saudi->geo(24.65017630, 46.71670870)->getAddressOne();
```

`getAddressOne()` aliases:  `addressOne()`.


- Get the address line 2 from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$addressTwo = $saudi->geo(24.65017630, 46.71670870)->getAddressTwo();
```

`getAddressTwo()` aliases:  `addressTwo()`.


- Get the street name from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$street = $saudi->geo(24.65017630, 46.71670870)->getStreet();
```

`getStreet()` aliases:  `street()`.


- Get the region from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$region = $saudi->geo(24.65017630, 46.71670870)->getRegion();
```

`getRegion()` aliases:  `region()`.


- Get the district from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$district = $saudi->geo(24.65017630, 46.71670870)->getDistrict();
```

`getDistrict()` aliases:  `district()`.


- Get the building number from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$buildingNumber = $saudi->geo(24.65017630, 46.71670870)->getBuildingNumber();
```

`getBuildingNumber()` aliases:  `buildingNumber()`.


- Get the post code (zip) from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$postCode = $saudi->geo(24.65017630, 46.71670870)->getPostCode();
```

`getPostCode()` aliases:  `postCode()`, `getZip()` and `zip()`.


- Get the additional number from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$additionalNumber = $saudi->geo(24.65017630, 46.71670870)->getAdditionalNumber();
```

`getAdditionalNumber()` aliases:  `additionalNumber()`.


----


### :mag: Address Lookup

- Find all the addresses using a string:
    - parameter `address string` is the "search string" and parameter `1` is the page #.

```php
$addresses = $saudi->address()->find('address string', 1)->all(); // return a list of addresses
```

***if page is set to `1` the package will loop through the pages and combine the results***

***Developer Subscriptions will sleep for 5 seconds before fetching the next page!***


----


### :white_check_mark: Verify an Address
- Verify an Address by building number, zip code and additional number.
    - parameters `8228` and `9999` are the building numbers.
    - parameters `12643` and `99999` are the zip codes.
    - parameters `2121` and `9999` are the additional numbers.

```php
$verified = $saudi->address()->verify(8228, 12643, 2121); // return true
$verified = $saudi->address()->verify(9999, 99999, 9999); // return false

```


----


## :bell: Other Information

This package was built by a single person within 2-3 days due to an actual need in a real-world project.

This is still considered simple but gets the job done. Plus contributions ([CONTRIBUTING](CONTRIBUTING.md)) are welcomed :grin:.

**:zap: Cache**

This package has a simple file cache system. Most of the API requests will be saved in the `Api/Cache/` directory due to the limitation on the Development subscription (1000 requests per month).

*Redis and other cache methods will be added in the future versions*


----


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email ali@aalharthi.sa instead of using the issue tracker.

## Credits

- [Ali Alharthi](https://github.com/ali-alharthi)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
