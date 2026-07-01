<?php

declare(strict_types=1);

namespace Inexdigital\UamAuthorization\Factory;

use Grpc\ChannelCredentials;
use Inexdigital\UamAuthorization\Grpc\Uam\Api\ApiClient;

class UamApiClientFactory
{
    public function create(string $endpoint, bool $insecure = false): ApiClient
    {
        return new ApiClient(
            $endpoint,
            [
                'credentials' => $insecure
                    ? ChannelCredentials::createInsecure()
                    : ChannelCredentials::createSsl(),
            ]
        );
    }
}
