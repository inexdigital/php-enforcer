<?php

declare(strict_types=1);

namespace Inexdigital\UamAuthorization\Dto;

use Google\Protobuf\RepeatedField;

readonly class Policy
{
    const TYPE_POLICY = 'p';
    const TYPE_GROUPING_POLICY = 'g';

    public static function createFromArray(RepeatedField $policy): static
    {
        return new static(
            isset($policy[0]) && $policy[0] === self::TYPE_GROUPING_POLICY
                ? self::TYPE_GROUPING_POLICY
                : self::TYPE_POLICY,
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
    ) {}

    public function getType(): string
    {
        return $this->type;
    }

    public function isGroupingPolicy(): bool
    {
        return $this->type === self::TYPE_GROUPING_POLICY;
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
