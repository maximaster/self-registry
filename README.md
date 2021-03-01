# maximaster/self-registry

Trait to make class to act like self-registry

## Usage

```bash
composer require maximaster/self-registry
```

```php
use Maximaster\SelfRegistry\SelfRegistryTrait;

class ApiClient
{
    use SelfRegistryTrait;
}
```

```php
$apiClient = new ApiClient();
$apiClient->registerItself();

// in the other part of an application

$apiClient = ApiClient::getInstance();
```
