<?php
namespace Enalquiler\Elastica\Test\Query;

use Enalquiler\Elastica\Query\Term;
use Enalquiler\Elastica\Test\Base as BaseTest;

class TermTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testToArray()
    {
        $query = new Term();
        $key = 'name';
        $value = 'nicolas';
        $boost = 2;
        $query->setTerm($key, $value, $boost);

        $data = $query->toArray();

        $this->assertInternalType('array', $data['term']);
        $this->assertInternalType('array', $data['term'][$key]);
        $this->assertEquals($data['term'][$key]['value'], $value);
        $this->assertEquals($data['term'][$key]['boost'], $boost);
    }

    /**
     * @group unit
     */
    public function testDiacriticsValueToArray()
    {
        $query = new Term();
        $key = 'name';
        $value = 'diprè';
        $boost = 2;
        $query->setTerm($key, $value, $boost);

        $data = $query->toArray();

        $this->assertInternalType('array', $data['term']);
        $this->assertInternalType('array', $data['term'][$key]);
        $this->assertEquals($data['term'][$key]['value'], $value);
        $this->assertEquals($data['term'][$key]['boost'], $boost);
    }
}
