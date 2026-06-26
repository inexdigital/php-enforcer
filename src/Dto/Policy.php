<?php

declare(strict_types=1);

namespace Inexdigital\Enforcer\Dto;

use Google\Protobuf\RepeatedField;

readonly class Policy
{
    public static function createFromArray(RepeatedField $policy): static
    {
        return new static(
            $policy[0] ?? 'p',
            $policy[1] ?? '',
            $policy[2] ?? '',
            $policy[3] ?? ''
        );
    }

    private function __construct(
        private string $type,
        private string $permission,
        private string $name,
        private string $expression,
    ) {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPermission(): string
    {
        return $this->permission;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getExpression(): string
    {
        return $this->expression;
    }
}
