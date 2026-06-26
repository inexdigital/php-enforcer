<?php

declare(strict_types=1);

namespace Inexdigital\Enforcer\Dto;

readonly class ABACConfig
{
    /**
     * @param Policy[] $policyList
     */
    public function __construct(
        public string $model,
        public array $policyList
    ) {
    }
}
