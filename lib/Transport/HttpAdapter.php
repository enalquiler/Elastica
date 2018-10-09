<?php
namespace Enalquiler\Elastica\Transport;

use Enalquiler\Elastica\Connection;
use Enalquiler\Elastica\Exception\PartialShardFailureException;
use Enalquiler\Elastica\Exception\ResponseException;
use Enalquiler\Elastica\JSON;
use Enalquiler\Elastica\Request as ElasticaRequest;
use Enalquiler\Elastica\Response as ElasticaResponse;
use Ivory\HttpAdapter\HttpAdapterInterface;
use Ivory\HttpAdapter\Message\Request as HttpAdapterRequest;
use Ivory\HttpAdapter\Message\Response as HttpAdapterResponse;
use Ivory\HttpAdapter\Message\Stream\StringStream;

class HttpAdapter extends AbstractTransport
{
    /**
     * @var HttpAdapterInterface
     */
    private $httpAdapter;

    /**
     * @var string
     */
    private $_scheme = 'http';

    /**
     * Construct transport.
     *
     * @param Connection           $connection
     * @param HttpAdapterInterface $httpAdapter
     */
    public function __construct(Connection $connection = null, HttpAdapterInterface $httpAdapter)
    {
        parent::__construct($connection);
        $this->httpAdapter = $httpAdapter;
    }

    /**
     * Makes calls to the elasticsearch server.
     *
     * All calls that are made to the server are done through this function
     *
     * @param \Enalquiler\Elastica\Request $elasticaRequest
     * @param array             $params          Host, Port, ...
     *
     * @throws \Enalquiler\Elastica\Exception\ConnectionException
     * @throws \Enalquiler\Elastica\Exception\ResponseException
     * @throws \Enalquiler\Elastica\Exception\Connection\HttpException
     *
     * @return \Enalquiler\Elastica\Response Response object
     */
    public function exec(ElasticaRequest $elasticaRequest, array $params)
    {
        $connection = $this->getConnection();

        if ($timeout = $connection->getTimeout()) {
            $this->httpAdapter->getConfiguration()->setTimeout($timeout);
        }

        $httpAdapterRequest = $this->_createHttpAdapterRequest($elasticaRequest, $connection);

        $start = microtime(true);
        $httpAdapterResponse = $this->httpAdapter->sendRequest($httpAdapterRequest);
        $end = microtime(true);

        $elasticaResponse = $this->_createElasticaResponse($httpAdapterResponse);
        $elasticaResponse->setQueryTime($end - $start);

        $elasticaResponse->setTransferInfo(
            [
                'request_header' => $httpAdapterRequest->getMethod(),
                'http_code' => $httpAdapterResponse->getStatusCode(),
            ]
        );

        if ($elasticaResponse->hasError()) {
            throw new ResponseException($elasticaRequest, $elasticaResponse);
        }

        if ($elasticaResponse->hasFailedShards()) {
            throw new PartialShardFailureException($elasticaRequest, $elasticaResponse);
        }

        return $elasticaResponse;
    }

    /**
     * @param HttpAdapterResponse $httpAdapterResponse
     *
     * @return ElasticaResponse
     */
    protected function _createElasticaResponse(HttpAdapterResponse $httpAdapterResponse)
    {
        return new ElasticaResponse((string) $httpAdapterResponse->getBody(), $httpAdapterResponse->getStatusCode());
    }

    /**
     * @param ElasticaRequest $elasticaRequest
     * @param Connection      $connection
     *
     * @return HttpAdapterRequest
     */
    protected function _createHttpAdapterRequest(ElasticaRequest $elasticaRequest, Connection $connection)
    {
        $data = $elasticaRequest->getData();
        $body = null;
        $method = $elasticaRequest->getMethod();
        $headers = $connection->hasConfig('headers') ?: [];
        if (!empty($data) || '0' === $data) {
            if ($method == ElasticaRequest::GET) {
                $method = ElasticaRequest::POST;
            }

            if ($this->hasParam('postWithRequestBody') && $this->getParam('postWithRequestBody') == true) {
                $elasticaRequest->setMethod(ElasticaRequest::POST);
                $method = ElasticaRequest::POST;
            }

            if (is_array($data)) {
                $body = JSON::stringify($data, JSON_UNESCAPED_UNICODE);
            } else {
                $body = $data;
            }
        }

        $url = $this->_getUri($elasticaRequest, $connection);
        $streamBody = new StringStream($body);

        return new HttpAdapterRequest($url, $method, HttpAdapterRequest::PROTOCOL_VERSION_1_1, $headers, $streamBody);
    }

    /**
     * @param ElasticaRequest      $request
     * @param \Enalquiler\Elastica\Connection $connection
     *
     * @return string
     */
    protected function _getUri(ElasticaRequest $request, Connection $connection)
    {
        $url = $connection->hasConfig('url') ? $connection->getConfig('url') : '';

        if (!empty($url)) {
            $baseUri = $url;
        } else {
            $baseUri = $this->_scheme.'://'.$connection->getHost().':'.$connection->getPort().'/'.$connection->getPath();
        }

        $baseUri .= $request->getPath();

        $query = $request->getQuery();

        if (!empty($query)) {
            $baseUri .= '?'.http_build_query($query);
        }

        return $baseUri;
    }
}
