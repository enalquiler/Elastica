<?php
namespace Enalquiler\Elastica\Test\Filter;

use Enalquiler\Elastica\Filter\MatchAll;
use Enalquiler\Elastica\Test\DeprecatedClassBase as BaseTest;

class MatchAllTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testDeprecated()
    {
        $reflection = new \ReflectionClass(new MatchAll());
        $this->assertFileDeprecated($reflection->getFileName(), 'Deprecated: Filters are deprecated. Use queries in filter context. See https://www.elastic.co/guide/en/elasticsearch/reference/2.0/query-dsl-filters.html');
    }

    /**
     * @group unit
     */
    public function testToArray()
    {
        $filter = new MatchAll();

        $expectedArray = ['match_all' => new \stdClass()];

        $this->assertEquals($expectedArray, $filter->toArray());
    }
}
