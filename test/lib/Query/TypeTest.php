<?php
namespace Enalquiler\Elastica\Test\Query;

use Enalquiler\Elastica\Query\Type;
use Enalquiler\Elastica\Test\Base as BaseTest;

class TypeTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testSetType()
    {
        $typeQuery = new Type();
        $returnValue = $typeQuery->setType('type_name');
        $this->assertInstanceOf('Enalquiler\Elastica\Query\Type', $returnValue);
    }

    /**
     * @group unit
     */
    public function testToArray()
    {
        $typeQuery = new Type('type_name');

        $expectedArray = [
            'type' => ['value' => 'type_name'],
        ];

        $this->assertEquals($expectedArray, $typeQuery->toArray());
    }
}
