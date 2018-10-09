<?php
namespace Enalquiler\Elastica\Connection\Strategy;

use Enalquiler\Elastica\Exception\ClientException;

/**
 * Description of SimpleStrategy.
 *
 * @author chabior
 */
class Simple implements StrategyInterface
{
    /**
     * @param array|\Enalquiler\Elastica\Connection[] $connections
     *
     * @throws \Enalquiler\Elastica\Exception\ClientException
     *
     * @return \Enalquiler\Elastica\Connection
     */
    public function getConnection($connections)
    {
        foreach ($connections as $connection) {
            if ($connection->isEnabled()) {
                return $connection;
            }
        }

        throw new ClientException('No enabled connection');
    }
}
