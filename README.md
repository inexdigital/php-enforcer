## UAM Authorization

Package for ABAC authorization based on User Access Management (UAM) service.

## Installation

```bash
composer require inexdigital/uam-authorization
```

## Usage

```yml
# symfony
Inexdigital\UamAuthorization\Factory\UamApiClientFactory: ~
Inexdigital\UamAuthorization\Factory\EnforcerFactory: ~
Inexdigital\UamAuthorization\Service\Enforcer: ~
Inexdigital\UamAuthorization\Service\UAMService: ~

Inexdigital\UamAuthorization\Grpc\Uam\Api\ApiClient:
  factory: ['@Inexdigital\UamAuthorization\Factory\UamApiClientFactory', 'create']
  arguments:
    $endpoint: '%env(USER_ACCESS_MANAGER_GRPC_ADDR)%'
    # Secure by default (TLS enabled).
    $insecure: false

Casbin\Enforcer:
  factory: [ '@Inexdigital\UamAuthorization\Factory\EnforcerFactory', 'create']
```

### Security note

- `UamApiClientFactory::create()` uses TLS by default (`$insecure: false`).
- Set `$insecure: true` only for local development/testing environments.
- Do not enable `$insecure: true` in production.

Example for local development only:

```yml
Inexdigital\UamAuthorization\Grpc\Uam\Api\ApiClient:
  factory: ['@Inexdigital\UamAuthorization\Factory\UamApiClientFactory', 'create']
  arguments:
    $endpoint: '%env(USER_ACCESS_MANAGER_GRPC_ADDR)%'
    $insecure: true
```

## Testing

```bash
phpunit
```

