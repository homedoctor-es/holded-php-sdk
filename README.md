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
$holded = new \HomedoctorEs\Holded\Holded($holdedApiKey); // or Holded::make($holdedApiKey)
$holded->contact()->list();
```

## Endpoints

At this moment, only can be managed 2 entities with this SDK: contacts and documents

### Contacts

To check contacts entity requirements and fields, you can see https://developers.holded.com/reference#contacts

The contacts entity use these methods

```php
$holded->contact()->list();
$holded->contact()->get($id);
$holded->contact()->create($data); //$data = []
$holded->contact()->update($data); //$data = []
$holded->contact()->delete($id);
```

### Documents

To check documents entity requirements and fields, you can see https://developers.holded.com/reference#documents

The contacts entity use these methods

```php
$holded->document()->list();
$holded->document()->get($id);
$holded->document()->create($data); //$data = []
$holded->document()->update($data); //$data = []
$holded->document()->delete($id); //$data = []
```

"docType" default value is invoice, if you want to instantiate another kind of document, you can pass docType param to document method

```php
$document = $holded->document(Document::PURCHASE_ORDER);
```

Check Document class constants to see the kind of docType you can use

If you want to instantiate directly and invoice document you can do it using ->invoice() method

```php
$invoice = $holded->invoice();
```