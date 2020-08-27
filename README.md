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
],
```

Then, append the following to the `.env` file:

```php
SNA_API_KEY=YOUR-API-KEY-HERE
SNA_API_SUBSCRIPTION=Development
```

Replace `YOUR-API-KEY-HERE` with your SNA API key and `Development` with your SNA subscription type.

After that you can use the facade: `AliAlharthi\SaudiAddress\Facades\SaudiAddressFacade` to access the library.

## Usage

### As a regualr PHP package:

``` php
use AliAlharthi\SaudiAddress\SaudiAddress;


$saudi = SaudiAddress::make('API-KEY', 'Subscription');
$regions = $saudi->regions()->all('E')->get();
```

### Laravel:

``` php
use AliAlharthi\SaudiAddress\Facades\SaudiAddressFacade;


$regions = SaudiAddressFacade::regions()->all('E')->get();
```


----


***In the following examples, parameter `'E'` stands for English. Default language is Arabic `'A'`***


### :earth_asia: Regions


- Get all regions:

```php
$regions = $saudi->regions()->all('E')->get();
```


- Get a region by ID:

```php
$region = $saudi->regions()->all('E')->getId(2);
```

`getId()` aliases:  `byId()` and `id()`.


- Get a region by Name:

```php
$region = $saudi->regions()->all('E')->getName('Dammam');
```

`getName()` aliases:  `byName()`, `name()` and `named()`.


----


### :earth_asia: Cities

***using `-1` as the region ID (on the `all()` method - before the language parameter) or leaving it empty will get all the cities of Saudi Arabia***

- Get all cities of Saudi Arabia:
    - parameter `-1` is the region ID.

```php
$cities = $saudi->cities()->all(-1, 'E')->get();
```


- Get all cities of a region ID:
    - parameter `3` is the region ID.

```php
$cities = $saudi->cities()->all(3, 'E')->get();
```


- Get a city by ID:

```php
$city = $saudi->cities()->all(-1, 'E')->getId(2);
```

`getId()` aliases:  `byId()` and `id()`.


- Get a city by Name:

```php
$city = $saudi->cities()->all(-1, 'E')->getName('Dammam');
```

`getName()` aliases:  `byName()`, `name()` and `named()`.


- Get a city by Governorate Name:

```php
$city = $saudi->cities()->all(-1, 'E')->getGov('Eastern Province');
```

`getGov()` aliases:  `byGovernorate()`, `byGov()` and `govName()`.


----


### :city_sunset: Districts


- Get all districts from a city ID:
    - parameter `13` is the city ID.

```php
$districts = $saudi->cities()->all(13, 'E')->get();
```


- Get a district by ID:
    - parameter `13` is the city ID.

```php
$district = $saudi->cities()->all(13, 'E')->getId(2);
```

`getId()` aliases:  `byId()` and `id()`.


- Get a district by Name:
    - parameter `13` is the city ID.

```php
$district = $saudi->cities()->all(13, 'E')->getName('Dammam');
```

`getName()` aliases:  `byName()`, `name()` and `named()`.


----


### :convenience_store: Services


- Get the service categories:

```php
$services = $saudi->services()->categories('E')->get();
```

`categories()` aliases:  `cat()` and `main()`.


- Get the sub services of from a category ID:
    - parameter `102` is the service category ID.

```php
$subServices = $saudi->services()->sub(102, 'E')->get();
```

`sub()` aliases:  `subCategories()` and `subServices()`.


- Get a service category / sub service by ID:
    - parameter `102` is the service category ID.
    - parameter `10210` is the sub service ID.

```php
$service = $saudi->cities()->categories('E')->getId(102);
$subservice = $saudi->cities()->sub(102, 'E')->getId(10210);
```

`getId()` aliases:  `byId()` and `id()`.


- Get a service category / sub service by Name:
    - parameter `102` is the service category ID.

```php
$service = $saudi->cities()->categories('E')->getName('Commercial');
$subservice = $saudi->cities()->sub(120, 'E')->getName('Supermarket');
```

`getName()` aliases:  `byName()`, `name()`, `serviceName()` and `named()`.


----


### :round_pushpin: GEO

- Address reverse (Get the address from geo coordinates):
    - parameter `24.65017630` is latitude and parameter `46.71670870` is longitude.


```php
$address = $saudi->->geo()->coordinates(24.65017630, 46.71670870, 'E')->get();
```

`coordinates()` aliases:  `coords()` and `location()`.


- Get the city from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$city = $saudi->->geo()->coordinates(24.65017630, 46.71670870, 'E')->getCity();
```

`getCity()` aliases:  `city()`.


- Get the address line 1 from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$addressOne = $saudi->->geo()->coordinates(24.65017630, 46.71670870, 'E')->getAddressOne();
```

`getAddressOne()` aliases:  `addressOne()`.


- Get the address line 2 from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$addressTwo = $saudi->->geo()->coordinates(24.65017630, 46.71670870, 'E')->getAddressTwo();
```

`getAddressTwo()` aliases:  `addressTwo()`.


- Get the street name from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$street = $saudi->->geo()->coordinates(24.65017630, 46.71670870, 'E')->getStreet();
```

`getStreet()` aliases:  `street()`.


- Get the region from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$region = $saudi->->geo()->coordinates(24.65017630, 46.71670870, 'E')->getRegion();
```

`getRegion()` aliases:  `region()`.


- Get the district from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$district = $saudi->->geo()->coordinates(24.65017630, 46.71670870, 'E')->getDistrict();
```

`getDistrict()` aliases:  `district()`.


- Get the building number from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$buildingNumber = $saudi->->geo()->coordinates(24.65017630, 46.71670870, 'E')->getBuildingNumber();
```

`getBuildingNumber()` aliases:  `buildingNumber()`.


- Get the post code (zip) from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$postCode = $saudi->->geo()->coordinates(24.65017630, 46.71670870, 'E')->getPostCode();
```

`getPostCode()` aliases:  `postCode()`, `getZip()` and `zip()`.


- Get the additional number from geo:
    - parameter `24.65017630` represents latitude and parameter `46.71670870` represents longitude.

```php
$additionalNumber = $saudi->->geo()->coordinates(24.65017630, 46.71670870, 'E')->getAdditionalNumber();
```

`getAdditionalNumber()` aliases:  `additionalNumber()`.


----


### :mag: Address Lookup

- Find all the addresses using a string:
    - parameter `address string` is the "search string" and parameter `1` is the page #.

```php
$addresses = $saudi->address()->find('address string', 1, 'E')->all(); // return a list of addresses
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
$verified = $saudi->address()->verify(8228, 12643, 2121, 'E'); // return true
$verified = $saudi->address()->verify(9999, 99999, 9999, 'E'); // return false

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
