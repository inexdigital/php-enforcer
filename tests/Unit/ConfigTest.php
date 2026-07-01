<?php
declare(strict_types=1);
namespace Tests\Unit;
use Inexdigital\UamAuthorization\Dto\Config;
use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    public function testStoresModelAndPolicyList(): void
    {
        $config = new Config('m = r.sub == p.sub', ['policy-1']);
        self::assertSame('m = r.sub == p.sub', $config->model);
        self::assertSame(['policy-1'], $config->policyList);
    }
}
