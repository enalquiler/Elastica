<?php
namespace Enalquiler\Elastica\Test\Connection\Strategy;

use Enalquiler\Elastica\Connection\Strategy\StrategyInterface;

/**
 * Description of EmptyStrategy.
 *
 * @author chabior
 */
class EmptyStrategy implements StrategyInterface
{
    public function getConnection($connections)
    {
        return;
    }
}
