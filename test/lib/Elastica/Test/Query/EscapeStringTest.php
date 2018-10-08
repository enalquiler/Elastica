<?php
namespace Enalquiler\Elastica\Test\Query;

use Enalquiler\Elastica\Document;
use Enalquiler\Elastica\Index;
use Enalquiler\Elastica\Query\QueryString;
use Enalquiler\Elastica\Test\Base as BaseTest;
use Enalquiler\Elastica\Type;
use Enalquiler\Elastica\Util;

class EscapeStringTest extends BaseTest
{
    /**
     * @group functional
     */
    public function testSearch()
    {
        $index = $this->_createIndex();
        $index->getSettings()->setNumberOfReplicas(0);

        $type = new Type($index, 'helloworld');

        $doc = new Document(1, [
            'email' => 'test@test.com', 'username' => 'test 7/6 123', 'test' => ['2', '3', '5'], ]
        );
        $type->addDocument($doc);

        // Refresh index
        $index->refresh();

        $queryString = new QueryString(Util::escapeTerm('test 7/6'));
        $resultSet = $type->search($queryString);

        $this->assertEquals(1, $resultSet->count());
    }
}
