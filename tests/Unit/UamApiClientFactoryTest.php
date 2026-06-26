<?php
declare(strict_types=1);
namespace Tests\Unit;
use Inexdigital\Enforcer\Factory\UamApiClientFactory;
use PHPUnit\Framework\TestCase;
final class UamApiClientFactoryTest extends TestCase
{
    public function testCreateUsesSslByDefault(): void
    {
        $client = (new UamApiClientFactory())->create('uam.internal:443');
        $credentials = $client->opts['credentials'] ?? null;
        self::assertSame('uam.internal:443', $client->hostname);
        self::assertNotNull($credentials);
    }

    public function testCreateUsesInsecureWhenExplicitlyRequested(): void
    {
        $client = (new UamApiClientFactory())->create('uam.internal:80', true);
        $credentials = $client->opts['credentials'] ?? null;
        self::assertSame('uam.internal:80', $client->hostname);
        self::assertTrue($credentials === null || $credentials === 'insecure');
    }
}
