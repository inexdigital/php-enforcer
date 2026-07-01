<?php
declare(strict_types=1);
namespace Tests\Unit;
use Google\Protobuf\RepeatedField;
use Inexdigital\UamAuthorization\Dto\Policy;
use PHPUnit\Framework\TestCase;
final class PolicyTest extends TestCase
{
    public function testCreateFromArrayMapsAllFields(): void
    {
        $policy = Policy::createFromArray(new RepeatedField(['p', 'read', 'orders', 'obj.owner == sub.id']));
        self::assertSame('p', $policy->getType());
        self::assertSame('read', $policy->getPermission());
        self::assertSame('orders', $policy->getName());
        self::assertSame('obj.owner == sub.id', $policy->getExpression());
    }

    public function testCreateFromArrayUsesDefaultsForMissingValues(): void
    {
        $policy = Policy::createFromArray(new RepeatedField([]));
        self::assertSame('p', $policy->getType());
        self::assertSame('', $policy->getPermission());
        self::assertSame('', $policy->getName());
        self::assertSame('', $policy->getExpression());
    }
}
