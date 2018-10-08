<?php
namespace Enalquiler\Elastica\Multi;

use Enalquiler\Elastica\Response;
use Enalquiler\Elastica\Search as BaseSearch;

interface MultiBuilderInterface
{
    /**
     * @param Response     $response
     * @param BaseSearch[] $searches
     *
     * @return ResultSet
     */
    public function buildMultiResultSet(Response $response, $searches);
}
