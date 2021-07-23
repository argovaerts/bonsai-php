# Bonsai API client for PHP

[Bonsai](https://www.paybonsai.com/bonsai-for-merchants/) is a Belgian payment app that for every ten payments plants a tree.

This is a community effort to make a PHP SDK to make the usage of the API more straight forward.

## Requirements

* Bonsai account with merchant functionality active
* >= PHP 8.0 (other version might work as well, untested)
* PHP cURL extension
* Up-to-date OpenSSL (or other SSL/TLS toolkit)

## Installation

By far the easiest way to install the Bonsai API client is to require it with Composer.

```
$ composer require argovaerts/bonsai-php

{
    "require": {
        "argovaerts/bonsai-php": "*"
    }
}
```

## Creating a payment

```{php}
use Bonsai\Api\BonsaiApiClient;

$client = new BonsaiApiClient('API_KEY', 'PROFILE_ID', <IS_TEST_BOOLEAN>);

$output = $this->client->create_transaction->perform([
    'amount'            => '0.01',
    'clientReference'   => 'reference or order id',
]);
```

## Want to improve the API client?
This project is open for pull requests.

## License

[BlueOak-1.0.0](LICENSE) © [Arne Govaerts](https://whoami.q4.re).