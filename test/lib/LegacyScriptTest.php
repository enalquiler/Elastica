<?php
namespace Enalquiler\Elastica\Test;

use Enalquiler\Elastica\Script as LegacyScript;
use Enalquiler\Elastica\Test\Base as BaseTest;

class LegacyScriptTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testParent()
    {
        $this->assertInstanceOf('Enalquiler\Elastica\Script\Script', new LegacyScript('script'));
    }
}
