<?php
namespace Enalquiler\Elastica\Exception;

use Enalquiler\Elastica\Request;
use Enalquiler\Elastica\Response;

/**
 * Connection exception.
 *
 * @author Nicolas Ruflin <spam@ruflin.com>
 */
class ConnectionException extends \RuntimeException implements ExceptionInterface
{
    /**
     * @var \Elastica\Request Request object
     */
    protected $_request;

    /**
     * @var \Elastica\Response Response object
     */
    protected $_response;

    /**
     * Construct Exception.
     *
     * @param string             $message  Message
     * @param \Enalquiler\Elastica\Request  $request
     * @param \Enalquiler\Elastica\Response $response
     */
    public function __construct($message, Request $request = null, Response $response = null)
    {
        $this->_request = $request;
        $this->_response = $response;

        parent::__construct($message);
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
}
