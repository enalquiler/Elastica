<?php
namespace Enalquiler\Elastica\Test\Query;

use Enalquiler\Elastica\Query\Nested;
use Enalquiler\Elastica\Query\QueryString;
use Enalquiler\Elastica\Test\Base as BaseTest;

class NestedTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testSetQuery()
    {
        $nested = new Nested();
        $path = 'test1';

        $queryString = new QueryString('test');
        $this->assertInstanceOf('Enalquiler\Elastica\Query\Nested', $nested->setQuery($queryString));
        $this->assertInstanceOf('Enalquiler\Elastica\Query\Nested', $nested->setPath($path));
        $expected = [
            'nested' => [
                'query' => $queryString->toArray(),
                'path' => $path,
            ],
        ];

        $this->assertEquals($expected, $nested->toArray());
    }
}
