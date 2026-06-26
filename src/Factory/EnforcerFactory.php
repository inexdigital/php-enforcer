<?php

declare(strict_types=1);

namespace Inexdigital\Enforcer\Factory;

use Casbin\Enforcer;
use Casbin\Model\Model;
use Inexdigital\Enforcer\Exception\PolicyAddException;
use Inexdigital\Enforcer\Service\UAMService;
use Psr\Log\LoggerInterface;
use Throwable;

class EnforcerFactory
{
    public function __construct(
        private readonly UAMService $uamService,
        private readonly LoggerInterface $logger
    ) {
    }

    public function create(): Enforcer
    {
        $config = $this->uamService->getABACConfig();
        $enforcer = new Enforcer();
        $model = Model::newModelFromString($config->model);
        $enforcer->setModel($model);

        foreach ($config->policyList as $policy) {
            try {
                if ($policy->getType() === 'g') {
                    $enforcer->addNamedGroupingPolicy(
                        'g',
                        $policy->getPermission(),
                        $policy->getName(),
                        $policy->getExpression()
                    );

                    continue;
                }

                $enforcer->addNamedPolicy(
                    'p',
                    $policy->getPermission(),
                    $policy->getName(),
                    $policy->getExpression()
                );
            } catch (Throwable $e) {
                $this->logger->error(
                    'Failed to add policy while building enforcer',
                    [
                        'type' => $policy->getType(),
                        'permission' => $policy->getPermission(),
                        'name' => $policy->getName(),
                        'expression' => $policy->getExpression(),
                        'exception' => $e
                    ]
                );

                throw PolicyAddException::create($e);
            }
        }

        return $enforcer;
    }
}
