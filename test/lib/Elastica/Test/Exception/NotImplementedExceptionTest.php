<?php
namespace Enalquiler\Elastica\Test\Exception;

use Enalquiler\Elastica\Exception\NotImplementedException;

class NotImplementedExceptionTest extends AbstractExceptionTest
{
    /**
     * @group unit
     */
    public function testInstance()
    {
        $code = 4;
        $message = 'Hello world';
        $exception = new NotImplementedException($message, $code);
        $this->assertEquals($message, $exception->getMessage());
        $this->assertEquals($code, $exception->getCode());
    }
}
