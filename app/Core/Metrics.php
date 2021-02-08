<?php

declare(strict_types=1);

use CurrencyUaBot\Core\Singleton;
use Prometheus\CollectorRegistry;
use Prometheus\Exception\MetricsRegistrationException;
use Prometheus\Storage\Redis;

class Metrics extends Singleton
{
    private const METRIC_HEALTH_CHECK_PREFIX = 'healthcheck_';
    /**
     * @var CollectorRegistry
     */
    private $registry;

    protected function __construct()
    {
        Redis::setDefaultOptions(
            [
                'host' => 'redis',
                'port' => 6379,
                'database' => 0,
                'password' => null,
                'timeout' => 0.1, // in seconds
                'read_timeout' => '10', // in seconds
                'persistent_connections' => false
            ]
        );
        $this->registry = CollectorRegistry::getDefault();
    }

    /**
     * @return CollectorRegistry
     */
    public function getRegistry(): CollectorRegistry
    {
        return $this->registry;
    }

    /**
     * @param string $metricName
     *
     * @throws MetricsRegistrationException
     */
    public function increaseMetric(string $metricName): void
    {
        $counter = $this->registry->getOrRegisterCounter('telegram_bots', $metricName, 'it increases');
        $counter->incBy(1, []);
    }

    /**
     * @param string $serverName
     *
     * @throws MetricsRegistrationException
     */
    public function increaseHealthCheck(string $serverName): void
    {
        $this->increaseMetric(self::METRIC_HEALTH_CHECK_PREFIX . $serverName);
    }
}
