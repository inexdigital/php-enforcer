<?php

declare(strict_types=1);

namespace Inexdigital\UamAuthorization\Service;

use Google\Protobuf\Internal\Message;
use Grpc\UnaryCall;
use Inexdigital\UamAuthorization\Dto\Config;
use Inexdigital\UamAuthorization\Dto\Policy;
use Inexdigital\UamAuthorization\Grpc\Uam\Api\ApiClient;
use Inexdigital\UamAuthorization\Grpc\Uam\Api\EnforcerConfigRequest;
use Inexdigital\UamAuthorization\Grpc\Uam\Api\EnforcerConfigResponse;
use Inexdigital\UamAuthorization\Grpc\Uam\Api\PolicyList;
use RuntimeException;

use const Grpc\STATUS_OK;

class UAMService
{
    public function __construct(
        private readonly ApiClient $client,
        private readonly int $timeoutMicroseconds = 2000000
    ) {
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        $enforceConfigRequest = new EnforcerConfigRequest();

        /** @var EnforcerConfigResponse $response */
        $response = $this->getResponse(
            $this->client->EnforcerConfigABAC(
                argument: $enforceConfigRequest,
                options: ['timeout' => $this->timeoutMicroseconds]
            )
        );

        $policyList = [];

        /** @var PolicyList $item */
        foreach ($response->getPolicyList() as $item) {
            $policy = $item->getPolicy();
            $policyList[] = Policy::createFromArray($policy);
        }

        return new Config($response->getModel(), $policyList);
    }

    private function getResponse(UnaryCall $unaryCall): Message
    {
        [$response, $status] = $unaryCall->wait();

        if ($status->code !== STATUS_OK) {
            throw new RuntimeException(
                sprintf('User access management gRPC error (%d): %s', $status->code, $status->details)
            );
        }

        if (!$response instanceof Message) {
            throw new RuntimeException('User access management gRPC invalid response format');
        }

        return $response;
    }
}
