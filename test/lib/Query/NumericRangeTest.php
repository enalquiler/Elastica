<?php
namespace Enalquiler\Elastica\Test\Query;

use Enalquiler\Elastica\Query\NumericRange;
use Enalquiler\Elastica\Test\Base as BaseTest;

class NumericRangeTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testAddField()
    {
        $rangeQuery = new NumericRange();
        $returnValue = $rangeQuery->addField('fieldName', ['to' => 'value']);
        $this->assertInstanceOf('Enalquiler\Elastica\Query\NumericRange', $returnValue);
    }

    /**
     * @group unit
     */
    public function testToArray()
    {
        $query = new NumericRange();

        $fromTo = ['from' => 'ra', 'to' => 'ru'];
        $query->addField('name', $fromTo);

        $expectedArray = [
            'numeric_range' => [
                'name' => $fromTo,
            ],
        ];

        $this->assertEquals($expectedArray, $query->toArray());
    }
}
