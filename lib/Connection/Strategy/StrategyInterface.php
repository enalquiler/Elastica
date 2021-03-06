<?php
namespace Enalquiler\Elastica\Connection\Strategy;

/**
 * Description of AbstractStrategy.
 *
 * @author chabior
 */
interface StrategyInterface
{
    /**
     * @param array|\Enalquiler\Elastica\Connection[] $connections
     *
     * @return \Enalquiler\Elastica\Connection
     */
    public function getConnection($connections);
}
