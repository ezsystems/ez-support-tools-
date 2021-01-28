<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace EzSystems\EzSupportToolsBundle\Tests\SystemInfo\Collector;

use EzSystems\EzSupportToolsBundle\SystemInfo\Collector\EzSystemInfoCollector;

use EzSystems\EzSupportToolsBundle\SystemInfo\Collector\JsonComposerLockSystemInfoCollector;
use EzSystems\EzSupportToolsBundle\SystemInfo\Value\EzSystemInfo;
use PHPUnit\Framework\TestCase;

class IbexaSystemInfoCollectorTest extends TestCase
{
    /** @var \EzSystems\EzSupportTools\VersionStability\VersionStabilityChecker|\PHPUnit\Framework\MockObject\MockObject */
    private $versionStabilityChecker;

    public function setUp(): void
    {
        $this->versionStabilityChecker = $this->createMock(VersionStabilityChecker::class);
    }

    public function testCollect(): void
    {
        $composerCollector = new JsonComposerLockSystemInfoCollector(
            $this->versionStabilityChecker,
            __DIR__ . '/_fixtures/composer.lock',
            __DIR__ . '/_fixtures/composer.json'
        );

        $systemInfoCollector = new IbexaSystemInfoCollector(
            $composerCollector, dirname(__DIR__, 5)
        );
        $systemInfo = $systemInfoCollector->collect();
        self::assertSame(EzSystemInfo::PRODUCT_NAME_OSS, $systemInfo->name);
        self::assertSame('2.5', $systemInfo->release);
    }
}
