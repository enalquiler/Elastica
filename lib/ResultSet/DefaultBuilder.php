<?php
namespace Enalquiler\Elastica\ResultSet;

use Enalquiler\Elastica\Query;
use Enalquiler\Elastica\Response;
use Enalquiler\Elastica\Result;
use Enalquiler\Elastica\ResultSet;

class DefaultBuilder implements BuilderInterface
{
    /**
     * Builds a ResultSet for a given Response.
     *
     * @param Response $response
     * @param Query    $query
     *
     * @return ResultSet
     */
    public function buildResultSet(Response $response, Query $query)
    {
        $results = $this->buildResults($response);
        $resultSet = new ResultSet($response, $query, $results);

        return $resultSet;
    }

    /**
     * Builds individual result objects.
     *
     * @param Response $response
     *
     * @return Result[]
     */
    private function buildResults(Response $response)
    {
        $data = $response->getData();
        $results = [];

        if (!isset($data['hits']['hits'])) {
            return $results;
        }

        foreach ($data['hits']['hits'] as $hit) {
            $results[] = new Result($hit);
        }

        return $results;
    }
}
