<?php
namespace Enalquiler\Elastica\Test\Transport;

use Enalquiler\Elastica\Request;
use Enalquiler\Elastica\Transport\AbstractTransport;

class DummyTransport extends AbstractTransport
{
    public function exec(Request $request, array $params)
    {
        // empty
    }
}
