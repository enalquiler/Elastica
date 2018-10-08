<?php
namespace Enalquiler\Elastica\Test;

use Enalquiler\Elastica\Document;
use Enalquiler\Elastica\Result;
use Enalquiler\Elastica\Test\Base as BaseTest;

class ResultSetTest extends BaseTest
{
    /**
     * @group functional
     */
    public function testGetters()
    {
        $index = $this->_createIndex();
        $type = $index->getType('test');

        $type->addDocuments([
            new Document(1, ['name' => 'elastica search']),
            new Document(2, ['name' => 'elastica library']),
            new Document(3, ['name' => 'elastica test']),
        ]);
        $index->refresh();

        $resultSet = $type->search('elastica search');

        $this->assertInstanceOf('Enalquiler\Elastica\ResultSet', $resultSet);
        $this->assertEquals(3, $resultSet->getTotalHits());
        $this->assertGreaterThan(0, $resultSet->getMaxScore());
        $this->assertInternalType('array', $resultSet->getResults());
        $this->assertEquals(3, count($resultSet));
    }

    /**
     * @group functional
     */
    public function testArrayAccess()
    {
        $index = $this->_createIndex();
        $type = $index->getType('test');

        $type->addDocuments([
            new Document(1, ['name' => 'elastica search']),
            new Document(2, ['name' => 'elastica library']),
            new Document(3, ['name' => 'elastica test']),
        ]);
        $index->refresh();

        $resultSet = $type->search('elastica search');

        $this->assertInstanceOf('Enalquiler\Elastica\ResultSet', $resultSet);
        $this->assertInstanceOf('Enalquiler\Elastica\Result', $resultSet[0]);
        $this->assertInstanceOf('Enalquiler\Elastica\Result', $resultSet[1]);
        $this->assertInstanceOf('Enalquiler\Elastica\Result', $resultSet[2]);

        $this->assertFalse(isset($resultSet[3]));
    }

    /**
     * @group functional
     */
    public function testDocumentsAccess()
    {
        $index = $this->_createIndex();
        $type = $index->getType('test');

        $type->addDocuments([
            new Document(1, ['name' => 'elastica search']),
            new Document(2, ['name' => 'elastica library']),
            new Document(3, ['name' => 'elastica test']),
        ]);
        $index->refresh();

        $resultSet = $type->search('elastica search');

        $this->assertInstanceOf('Enalquiler\Elastica\ResultSet', $resultSet);

        $documents = $resultSet->getDocuments();

        $this->assertInternalType('array', $documents);
        $this->assertEquals(3, count($documents));
        $this->assertInstanceOf('Enalquiler\Elastica\Document', $documents[0]);
        $this->assertInstanceOf('Enalquiler\Elastica\Document', $documents[1]);
        $this->assertInstanceOf('Enalquiler\Elastica\Document', $documents[2]);
        $this->assertFalse(isset($documents[3]));
        $this->assertEquals('elastica search', $documents[0]->get('name'));
    }

    /**
     * @group functional
     * @expectedException \Enalquiler\Elastica\Exception\InvalidException
     */
    public function testInvalidOffsetCreation()
    {
        $index = $this->_createIndex();
        $type = $index->getType('test');

        $doc = new Document(1, ['name' => 'elastica search']);
        $type->addDocument($doc);
        $index->refresh();

        $resultSet = $type->search('elastica search');

        $result = new Result(['_id' => 'fakeresult']);
        $resultSet[1] = $result;
    }

    /**
     * @group functional
     * @expectedException \Enalquiler\Elastica\Exception\InvalidException
     */
    public function testInvalidOffsetGet()
    {
        $index = $this->_createIndex();
        $type = $index->getType('test');

        $doc = new Document(1, ['name' => 'elastica search']);
        $type->addDocument($doc);
        $index->refresh();

        $resultSet = $type->search('elastica search');

        return $resultSet[3];
    }
}
