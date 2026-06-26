## Php enforce

Package for work with user access management system

## Installation

```bash
composer require inexdigital/php-enforcer
```

## Usage

```yml
# symfony
Inexdigital\Enforcer\Factory\UamApiClientFactory: ~
Inexdigital\Enforcer\Factory\EnforcerFactory: ~
Inexdigital\Enforcer\Service\ABACEnforcer: ~
Inexdigital\Enforcer\Service\UAMService: ~

Inexdigital\Enforcer\Grpc\Uam\Api\ApiClient:
  factory: ['@Inexdigital\Enforcer\Factory\UamApiClientFactory', 'create']
  arguments:
    $endpoint: '%env(USER_ACCESS_MANAGEMENT_GRPC_ENDPOINT)%'
    # Secure by default (TLS enabled).
    $insecure: false

Casbin\Enforcer:
  factory: [ '@Inexdigital\Enforcer\Factory\EnforcerFactory', 'create']
```

### Security note

- `UamApiClientFactory::create()` uses TLS by default (`$insecure: false`).
- Set `$insecure: true` only for local development/testing environments.
- Do not enable `$insecure: true` in production.

Example for local development only:

```yml
Inexdigital\Enforcer\Grpc\Uam\Api\ApiClient:
  factory: ['@Inexdigital\Enforcer\Factory\UamApiClientFactory', 'create']
  arguments:
    $endpoint: '%env(USER_ACCESS_MANAGEMENT_GRPC_ENDPOINT)%'
    $insecure: true
```

## Testing

```bash
phpunit
```

