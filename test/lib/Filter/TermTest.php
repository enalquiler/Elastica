<?php
namespace Enalquiler\Elastica\Test\Filter;

use Enalquiler\Elastica\Filter\Term;
use Enalquiler\Elastica\Test\DeprecatedClassBase as BaseTest;

class TermTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testDeprecated()
    {
        $reflection = new \ReflectionClass(new Term());

        $this->assertFileDeprecated(
            $reflection->getFileName(),
            'Deprecated: Filters are deprecated. Use queries in filter context. See https://www.elastic.co/guide/en/elasticsearch/reference/2.0/query-dsl-filters.html'
        );
    }

    /**
     * @group unit
     */
    public function testToArray()
    {
        $query = new Term();
        $key = 'name';
        $value = 'ruflin';
        $query->setTerm($key, $value);

        $data = $query->toArray();

        $this->assertInternalType('array', $data['term']);
        $this->assertEquals([$key => $value], $data['term']);
    }
}
