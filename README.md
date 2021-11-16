Holded PHP SDK
===============
A PHP package to access the Holded API by a comprehensive way

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

With Composer installed, you can then install the extension using the following commands:

```bash
$ php composer.phar require homedoctor-es/holded-php-sdk
```

or add

```json
...
    "require": {
        "homedoctor-es/holded-php-sdk": "*"
    }
```

to the ```require``` section of your `composer.json` file.

## Configuration

You can set the HOLDED_API_TOKEN as environment variables or add them later
on Holded class instantiation.

The name of the environment var is HOLDED_API_KEY.

## Usage

Endpoints calls must done through the Holded class.

If you haven't set the environment variable previously, remember to provide the
key on instantiation.

```php
$holded = new \HomedoctorEs\Holded\Holded($holdedApiKey);
$holded->contacts()->getList();
```