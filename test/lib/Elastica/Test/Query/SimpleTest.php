<?php
namespace Enalquiler\Elastica\Test\Query;

use Enalquiler\Elastica\Query\Simple;
use Enalquiler\Elastica\Test\Base as BaseTest;

class SimpleTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testToArray()
    {
        $testQuery = ['hello' => ['world'], 'name' => 'ruflin'];
        $query = new Simple($testQuery);

        $this->assertEquals($testQuery, $query->toArray());
    }
}
