<?php
namespace Enalquiler\Elastica\Test\Query;

use Enalquiler\Elastica\Query\Limit;
use Enalquiler\Elastica\Test\Base as BaseTest;

class LimitTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testSetType()
    {
        $query = new Limit(10);
        $this->assertEquals(10, $query->getParam('value'));

        $this->assertInstanceOf('Enalquiler\Elastica\Query\Limit', $query->setLimit(20));
        $this->assertEquals(20, $query->getParam('value'));
    }

    /**
     * @group unit
     */
    public function testToArray()
    {
        $query = new Limit(15);

        $expectedArray = [
            'limit' => ['value' => 15],
        ];

        $this->assertEquals($expectedArray, $query->toArray());
    }
}
