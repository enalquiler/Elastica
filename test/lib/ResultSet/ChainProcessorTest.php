<?php
namespace Enalquiler\Elastica\Test\Transformer;

use Enalquiler\Elastica\Query;
use Enalquiler\Elastica\Response;
use Enalquiler\Elastica\ResultSet;
use Enalquiler\Elastica\ResultSet\ChainProcessor;
use Enalquiler\Elastica\Test\Base as BaseTest;

/**
 * @group unit
 */
class ChainProcessorTest extends BaseTest
{
    public function testProcessor()
    {
        $processor = new ChainProcessor([
            $processor1 = $this->getMockBuilder('Enalquiler\\Elastica\\ResultSet\\ProcessorInterface')->getMock(),
            $processor2 = $this->getMockBuilder('Enalquiler\\Elastica\\ResultSet\\ProcessorInterface')->getMock(),
        ]);
        $resultSet = new ResultSet(new Response(''), new Query(), []);

        $processor1->expects($this->once())
            ->method('process')
            ->with($resultSet);
        $processor2->expects($this->once())
            ->method('process')
            ->with($resultSet);

        $processor->process($resultSet);
    }
}
