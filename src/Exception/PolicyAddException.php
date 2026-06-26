<?php

declare(strict_types=1);

namespace Inexdigital\Enforcer\Exception;

use RuntimeException;
use Throwable;

class PolicyAddException extends RuntimeException
{
    public static function create(Throwable $previous): self
    {
        return new self('Failed to add policy from UAM policy list', 0, $previous);
    }
}

