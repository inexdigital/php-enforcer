<?php

declare(strict_types=1);

namespace Inexdigital\Enforcer\Service;

use Casbin\Enforcer;
use Casbin\Exceptions\CasbinException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ABACEnforcer
{
    public function __construct(
        private readonly Enforcer $enforcer,
        private readonly LoggerInterface $logger,
    ) {
    }

    public function enforce(string $name, UserInterface $sub, object $obj): bool
    {
        try {
            foreach ($sub->getRoles() as $role) {
                $isAllowed = $this->enforcer->enforce($role, $name, $sub, $obj);

                if (!$isAllowed) {
                    continue;
                }

                return true;
            }
        } catch (CasbinException $e) {
            $this->logger->error(
                'ABAC enforce failed: CasbinException while evaluating access policy',
                [
                    'action' => $name,
                    'user' => $sub->getUserIdentifier(),
                    'roles' => $sub->getRoles(),
                    'exception' => $e,
                ]
            );
        }

        return false;
    }
}
