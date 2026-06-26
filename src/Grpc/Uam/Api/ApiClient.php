<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Inexdigital\Enforcer\Grpc\Uam\Api;

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
     * @param \Inexdigital\Enforcer\Grpc\Uam\Api\EnforceRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function Enforce(\Inexdigital\Enforcer\Grpc\Uam\Api\EnforceRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/app.Api/Enforce',
        $argument,
        ['\Inexdigital\Enforcer\Grpc\Uam\Api\EnforceResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Inexdigital\Enforcer\Grpc\Uam\Api\EnforcerConfigRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function EnforcerConfigRBAC(\Inexdigital\Enforcer\Grpc\Uam\Api\EnforcerConfigRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/app.Api/EnforcerConfigRBAC',
        $argument,
        ['\Inexdigital\Enforcer\Grpc\Uam\Api\EnforcerConfigResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Inexdigital\Enforcer\Grpc\Uam\Api\EnforcerConfigRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function EnforcerConfigABAC(\Inexdigital\Enforcer\Grpc\Uam\Api\EnforcerConfigRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/app.Api/EnforcerConfigABAC',
        $argument,
        ['\Inexdigital\Enforcer\Grpc\Uam\Api\EnforcerConfigResponse', 'decode'],
        $metadata, $options);
    }

}
