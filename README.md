# APIstax PHP Client

[![Latest Version](https://img.shields.io/github/v/tag/apistax/client-php?label=Latest%20Version)](https://packagist.org/packages/apistax/client)
[![License](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)

APIstax PHP client is a complete PHP client implementation for the [APIstax](https://apistax.io?utm_source=github&utm_medium=apistax-php-client&utm_campaign=readme) platform.

## Usage

Install the latest version:

```bash
composer require 'apistax/client'
```

Get your APIstax API key [here](https://app.apistax.io/api-keys?utm_source=github&utm_medium=apistax-php-client&utm_campaign=readme).

Initialise an `APIstaxClient` and start using it.

```php
<?php

$config = new \APIstax\Configuration();
$config->setApiKey("API_KEY");

$client = new \APIstax\APIstaxClient($config);

$payload = new \APIstax\Models\VatVerificationPayload();
$payload->setVatId("VAT_ID");

$result = $this->client->verifyVatId($payload);
```

The further information and documentation about the APIs can be found on [APIstax documentation](https://apistax.io/docs?utm_source=github&utm_medium=apistax-php-client&utm_campaign=readme) page.