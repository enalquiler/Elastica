<?php
namespace Enalquiler\Elastica\Connection\Strategy;

/**
 * Description of RoundRobin.
 *
 * @author chabior
 */
class RoundRobin extends Simple
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
        shuffle($connections);

        return parent::getConnection($connections);
    }
}
