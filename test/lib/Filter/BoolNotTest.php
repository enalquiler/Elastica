<?php
namespace Enalquiler\Elastica\Test\Filter;

use Enalquiler\Elastica\Filter\BoolNot;
use Enalquiler\Elastica\Filter\Exists;
use Enalquiler\Elastica\Filter\Ids;
use Enalquiler\Elastica\Test\DeprecatedClassBase as BaseTest;

class BoolNotTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testDeprecated()
    {
        $reflection = new \ReflectionClass(new BoolNot(new Exists('a')));
        $this->assertFileDeprecated($reflection->getFileName(), 'Deprecated: Filters are deprecated. Use BoolQuery::addMustNot. See https://www.elastic.co/guide/en/elasticsearch/reference/2.0/query-dsl-filters.html');
    }

    /**
     * @group unit
     */
    public function testToArray()
    {
        $idsFilter = new Ids();
        $idsFilter->setIds(12);
        $filter = new BoolNot($idsFilter);

        $expectedArray = [
            'not' => [
                'filter' => $idsFilter->toArray(),
            ],
        ];

        $this->assertEquals($expectedArray, $filter->toArray());
    }
}