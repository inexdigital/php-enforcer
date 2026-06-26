<?php
declare(strict_types=1);
namespace Tests\Unit;
require_once __DIR__ . '/TestDoubles.php';
use Casbin\Enforcer;
use Casbin\Exceptions\CasbinException;
use Inexdigital\Enforcer\Service\ABACEnforcer;
use PHPUnit\Framework\TestCase;

final class ABACEnforcerTest extends TestCase
{
    public function testEnforceReturnsTrueWhenAnyRoleIsAllowed(): void
    {
        $casbin = new Enforcer();
        $casbin->enforceMap = [
            'ROLE_USER' => false,
            'ROLE_ADMIN' => true,
        ];
        $logger = new SpyLogger();
        $service = new ABACEnforcer($casbin, $logger);
        $result = $service->enforce('orders.read', new FakeUser(['ROLE_USER', 'ROLE_ADMIN']), (object) ['id' => 1]);
        self::assertTrue($result);
    }

    public function testEnforceReturnsFalseWhenNoRoleIsAllowed(): void
    {
        $casbin = new Enforcer();
        $casbin->enforceMap = [
            'ROLE_USER' => false,
            'ROLE_MANAGER' => false,
        ];
        $logger = new SpyLogger();
        $service = new ABACEnforcer($casbin, $logger);
        $result = $service->enforce('orders.read', new FakeUser(['ROLE_USER', 'ROLE_MANAGER']), (object) ['id' => 1]);
        self::assertFalse($result);
    }

    public function testEnforceReturnsFalseAndLogsWhenCasbinThrows(): void
    {
        $casbin = new Enforcer();
        $casbin->throwOnEnforce = new CasbinException('casbin-failed');
        $logger = new SpyLogger();
        $service = new ABACEnforcer($casbin, $logger);
        $result = $service->enforce('orders.read', new FakeUser(['ROLE_USER'], 'john@doe.test'), (object) ['id' => 1]);
        self::assertFalse($result);
        self::assertNotEmpty($logger->records);
        self::assertSame('error', $logger->records[0]['level']);
        self::assertSame('orders.read', $logger->records[0]['context']['action']);
        self::assertSame('john@doe.test', $logger->records[0]['context']['user']);
    }
}
