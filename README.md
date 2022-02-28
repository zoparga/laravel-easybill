# easybill.de REST API v1

[![Latest Stable Version](https://poser.pugx.org/zoparga/easybill/v/stable?format=flat-square)](https://packagist.org/packages/zoparga/easybill)
[![Total Downloads](https://poser.pugx.org/zoparga/easybill/downloads?format=flat-square)](https://packagist.org/packages/zoparga/easybill)
[![StyleCI](https://github.styleci.io/repos/90948270/shield?branch=master)](https://github.styleci.io/repos/90948270)
[![License](https://poser.pugx.org/zoparga/easybill/license?format=flat-square)](https://packagist.org/packages/zoparga/easybill)

**Unofficial** Laravel Package to use the [easybill.de REST API](https://www.easybill.de/api).

This Laravel Package is a very basic and untested version!

## Installation

```
composer require zoparga/easybill
```

## Laravel 5.5+

No need to register any providers / aliases. Thanks to [Laravels Package Discovery](https://laravel.com/docs/6.0/packages#package-discovery).

## Laravel 5.4

Add the ServiceProvider and Facade in ```config/app.php```

```php
'providers' => [
    ...
    zoparga\EasyBill\EasybillServiceProvider::class,
];

'aliases' => [
    ...
    'EasyBill' => zoparga\EasyBill\Facade\EasyBill::class,
];
```

## Configuration

Add your easybill.de api key to your ```.env```

```
EASYBILL_API_KEY=xxxxxx
```

## Usage

I only implemented some basic api calls

```php
// Search Customer with exact match
EasyBill::searchCustomer([
    'company_name' => 'Company Name'
]);

// Create Customer
$customer = EasyBill::createCustomer([
    'company_name' => 'Musterfirma GmbH',
    'first_name' => 'Max',
    'last_name' => 'Muster',
    'street' => 'Musterstr. 123',
    'zipcode' => '12345',
    'city' => 'Musterstadt',
    'emails' => ['mail@example.com'],
]);

// Delete Customer
EasyBill::deleteCustomer($customer->id);

// Create Document (Invoice)
$doc = EasyBill::createDocument([
    'type' => 'INVOICE',
    'title' => 'Titel',
    //'customer_id' => 0,
    'text_prefix' => 'Hello',
    'text' => 'Bye',
    'items' => [
        [
            'type' => 'POSITION',
            'number' => '123', // article number
            'description' => 'Positionsbeschreibung 1',
            'quantity' => 1,
            'single_price_net' => 10 * 100, // cent
            'vat_percent' => 19
        ],
        [
            'type' => 'TEXT',
            'description' => 'Text only',
        ],
        [
            'type' => 'POSITION',
            'description' => 'Positionsbeschreibung 3',
            'quantity' => 1,
            'single_price_net' => 20 * 100,
            'vat_percent' => 19
        ],
    ],
]);

// Finish Document (set auto created document number)
$doc->done();


$pdf = EasyBill::getPDF($pdfID);
$resultPdf = $pdf->->getBody();

// Update Document
EasyBill::updateDocument($id, ['status' => 'DONE']);
```

## Contributing

If you find an issue, or have a better way to do something, feel free to open an issue or a pull request.
