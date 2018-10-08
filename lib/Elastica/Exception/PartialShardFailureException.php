<?php
namespace Enalquiler\Elastica\Exception;

use Enalquiler\Elastica\JSON;
use Enalquiler\Elastica\Request;
use Enalquiler\Elastica\Response;

/**
 * Partial shard failure exception.
 *
 * @author Ian Babrou <ibobrik@gmail.com>
 */
class PartialShardFailureException extends ResponseException
{
    /**
     * Construct Exception.
     *
     * @param \Enalquiler\Elastica\Request  $request
     * @param \Enalquiler\Elastica\Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);

        $shardsStatistics = $response->getShardsStatistics();
        $this->message = JSON::stringify($shardsStatistics);
    }
}
