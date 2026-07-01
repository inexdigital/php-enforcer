<?php

declare(strict_types=1);

namespace Inexdigital\UamAuthorization\Dto;

readonly class Config
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
