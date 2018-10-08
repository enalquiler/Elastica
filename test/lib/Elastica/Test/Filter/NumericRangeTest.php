<?php
namespace Enalquiler\Elastica\Test\Filter;

use Enalquiler\Elastica\Filter\NumericRange;
use Enalquiler\Elastica\Test\DeprecatedClassBase as BaseTest;

class NumericRangeTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testDeprecated()
    {
        $reflection = new \ReflectionClass(new NumericRange());
        $this->assertFileDeprecated($reflection->getFileName(), 'Deprecated: Filters are deprecated. Use queries in filter context. See https://www.elastic.co/guide/en/elasticsearch/reference/2.0/query-dsl-filters.html');
    }

    /**
     * @group unit
     */
    public function testAddField()
    {
        $rangeFilter = new NumericRange();
        $returnValue = $rangeFilter->addField('fieldName', ['to' => 'value']);
        $this->assertInstanceOf('Enalquiler\Elastica\Filter\NumericRange', $returnValue);
    }

    /**
     * @group unit
     */
    public function testToArray()
    {
        $filter = new NumericRange();

        $fromTo = ['from' => 'ra', 'to' => 'ru'];
        $filter->addField('name', $fromTo);

        $expectedArray = [
            'numeric_range' => [
                'name' => $fromTo,
            ],
        ];

        $this->assertEquals($expectedArray, $filter->toArray());
    }
}
