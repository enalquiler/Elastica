<?php
namespace Enalquiler\Elastica\Exception;

use Enalquiler\Elastica\Request;
use Enalquiler\Elastica\Response;

/**
 * Response exception.
 *
 * @author Nicolas Ruflin <spam@ruflin.com>
 */
class ResponseException extends \RuntimeException implements ExceptionInterface
{
    /**
     * @var \Enalquiler\Elastica\Request Request object
     */
    protected $_request;

    /**
     * @var \Enalquiler\Elastica\Response Response object
     */
    protected $_response;

    /**
     * Construct Exception.
     *
     * @param \Enalquiler\Elastica\Request  $request
     * @param \Enalquiler\Elastica\Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->_request = $request;
        $this->_response = $response;
        parent::__construct($response->getErrorMessage());
    }

    /**
     * Returns request object.
     *
     * @return \Enalquiler\Elastica\Request Request object
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * Returns response object.
     *
     * @return \Enalquiler\Elastica\Response Response object
     */
    public function getResponse()
    {
        return $this->_response;
    }

    /**
     * Returns elasticsearch exception.
     *
     * @return ElasticsearchException
     */
    public function getElasticsearchException()
    {
        $response = $this->getResponse();
        $transfer = $response->getTransferInfo();
        $code = array_key_exists('http_code', $transfer) ? $transfer['http_code'] : 0;

        return new ElasticsearchException($code, $response->getErrorMessage());
    }
}
