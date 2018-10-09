<?php
namespace Enalquiler\Elastica\Multi;

use Enalquiler\Elastica\Response;
use Enalquiler\Elastica\Search as BaseSearch;

class MultiBuilder implements MultiBuilderInterface
{
    /**
     * @param Response     $response
     * @param BaseSearch[] $searches
     *
     * @return ResultSet
     */
    public function buildMultiResultSet(Response $response, $searches)
    {
        $resultSets = $this->buildResultSets($response, $searches);

        return new ResultSet($response, $resultSets);
    }

    /**
     * @param Response   $childResponse
     * @param BaseSearch $search
     *
     * @return \Enalquiler\Elastica\ResultSet
     */
    private function buildResultSet(Response $childResponse, BaseSearch $search)
    {
        return $search->getResultSetBuilder()->buildResultSet($childResponse, $search->getQuery());
    }

    /**
     * @param Response     $response
     * @param BaseSearch[] $searches
     *
     * @return \Enalquiler\Elastica\ResultSet[]
     */
    private function buildResultSets(Response $response, $searches)
    {
        $data = $response->getData();
        if (!isset($data['responses']) || !is_array($data['responses'])) {
            return [];
        }

        $resultSets = [];
        reset($searches);

        foreach ($data['responses'] as $responseData) {
            list($key, $search) = each($searches);

            $resultSets[$key] = $this->buildResultSet(new Response($responseData), $search);
        }

        return $resultSets;
    }
}
