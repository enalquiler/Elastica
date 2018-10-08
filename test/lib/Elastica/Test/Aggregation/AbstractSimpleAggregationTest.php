<?php
namespace Enalquiler\Elastica\Test\Aggregation;

class AbstractSimpleAggregationTest extends BaseAggregationTest
{
    public function setUp()
    {
        $this->aggregation = $this->getMockForAbstractClass(
            'Enalquiler\Elastica\Aggregation\AbstractSimpleAggregation',
            ['whatever']
        );
    }

    public function testToArrayThrowsExceptionOnUnsetParams()
    {
        $this->setExpectedException(
            'Enalquiler\Elastica\Exception\InvalidException',
            'Either the field param or the script param should be set'
        );

        $this->aggregation->toArray();
    }
}
