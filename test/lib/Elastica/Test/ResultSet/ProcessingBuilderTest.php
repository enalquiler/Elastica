<?php
namespace Enalquiler\Elastica\Test\ResultSet;

use Enalquiler\Elastica\Query;
use Enalquiler\Elastica\Response;
use Enalquiler\Elastica\ResultSet;
use Enalquiler\Elastica\ResultSet\BuilderInterface;
use Enalquiler\Elastica\Test\Base as BaseTest;

/**
 * @group unit
 */
class ProcessingBuilderTest extends BaseTest
{
    /**
     * @var ResultSet\ProcessingBuilder
     */
    private $builder;

    /**
     * @var BuilderInterface
     */
    private $innerBuilder;

    /**
     * @var ResultSet\ProcessorInterface
     */
    private $processor;

    protected function setUp()
    {
        parent::setUp();

        $this->innerBuilder = $this->getMock('Enalquiler\\Elastica\\ResultSet\\BuilderInterface');
        $this->processor = $this->getMock('Enalquiler\\Elastica\\ResultSet\\ProcessorInterface');

        $this->builder = new ResultSet\ProcessingBuilder($this->innerBuilder, $this->processor);
    }

    public function testProcessors()
    {
        $response = new Response('');
        $query = new Query();
        $resultSet = new ResultSet($response, $query, []);

        $this->innerBuilder->expects($this->once())
            ->method('buildResultSet')
            ->with($response, $query)
            ->willReturn($resultSet);
        $this->processor->expects($this->once())
            ->method('process')
            ->with($resultSet);

        $this->builder->buildResultSet($response, $query);
    }
}
