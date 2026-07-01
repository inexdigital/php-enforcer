<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Inexdigital\UamAuthorization\Grpc\Uam\Api;

/**
 */
class ApiClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Inexdigital\UamAuthorization\Grpc\Uam\Api\EnforcerConfigRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall<\Inexdigital\UamAuthorization\Grpc\Uam\Api\EnforcerConfigResponse>
     */
    public function EnforcerConfigABAC(\Inexdigital\UamAuthorization\Grpc\Uam\Api\EnforcerConfigRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/app.Api/EnforcerConfigABAC',
        $argument,
        ['\Inexdigital\UamAuthorization\Grpc\Uam\Api\EnforcerConfigResponse', 'decode'],
        $metadata, $options);
    }

}
