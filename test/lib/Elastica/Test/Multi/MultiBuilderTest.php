<?php
namespace Enalquiler\Elastica\Test\Multi;

use Enalquiler\Elastica\Multi\MultiBuilder;
use Enalquiler\Elastica\Response;
use Enalquiler\Elastica\ResultSet;
use Enalquiler\Elastica\ResultSet\BuilderInterface;
use Enalquiler\Elastica\Search;
use Enalquiler\Elastica\Test\Base as BaseTest;

/**
 * @group unit
 */
class MultiBuilderTest extends BaseTest
{
    /**
     * @var BuilderInterface
     */
    private $builder;

    /**
     * @var MultiBuilder
     */
    private $multiBuilder;

    protected function setUp()
    {
        parent::setUp();

        $this->builder = $this->getMock('Enalquiler\\Elastica\\ResultSet\\BuilderInterface');
        $this->multiBuilder = new MultiBuilder($this->builder);
    }

    public function testBuildEmptyMultiResultSet()
    {
        $this->builder->expects($this->never())
            ->method('buildResultSet');

        $response = new Response([]);
        $searches = [];

        $result = $this->multiBuilder->buildMultiResultSet($response, $searches);

        $this->assertInstanceOf('Enalquiler\Elastica\\Multi\\ResultSet', $result);
    }

    public function testBuildMultiResultSet()
    {
        $response = new Response([
            'responses' => [
                [],
                [],
            ],
        ]);
        $searches = [
            $s1 = new Search($this->_getClient(), $this->builder),
            $s2 = new Search($this->_getClient(), $this->builder),
        ];
        $resultSet1 = new ResultSet(new Response([]), $s1->getQuery(), []);
        $resultSet2 = new ResultSet(new Response([]), $s2->getQuery(), []);

        $this->builder->expects($this->exactly(2))
            ->method('buildResultSet')
            ->withConsecutive(
                [$this->isInstanceOf('Enalquiler\\Elastica\\Response'), $s1->getQuery()],
                [$this->isInstanceOf('Enalquiler\\Elastica\\Response'), $s2->getQuery()]
            )
            ->willReturnOnConsecutiveCalls($resultSet1, $resultSet2);

        $result = $this->multiBuilder->buildMultiResultSet($response, $searches);

        $this->assertInstanceOf('Enalquiler\\Elastica\\Multi\\ResultSet', $result);
        $this->assertSame($resultSet1, $result[0]);
        $this->assertSame($resultSet2, $result[1]);
    }
}
