<?php
namespace Enalquiler\Elastica\ResultSet;

use Enalquiler\Elastica\Query;
use Enalquiler\Elastica\Response;
use Enalquiler\Elastica\ResultSet;

interface BuilderInterface
{
    /**
     * Builds a ResultSet given a specific response and query.
     *
     * @param Response $response
     * @param Query    $query
     *
     * @return ResultSet
     */
    public function buildResultSet(Response $response, Query $query);
}
