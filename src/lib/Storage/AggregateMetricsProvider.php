<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace EzSystems\EzSupportTools\Storage;

use EzSystems\EzSupportToolsBundle\SystemInfo\Exception\MetricsNotFoundException;

/**
 * @internal
 */
final class AggregateMetricsProvider implements MetricsProvider
{
    /** @var iterable */
    private $metrics;

    public function __construct(iterable $metrics)
    {
        $this->metrics = $metrics;
    }

    public function provideMetrics(string $identifier): Metrics
    {
        foreach ($this->metrics as $metricKey => $metric) {
            if ($metricKey === $identifier) {
                return $metric;
            }
        }

        throw new MetricsNotFoundException($identifier);
    }
}
