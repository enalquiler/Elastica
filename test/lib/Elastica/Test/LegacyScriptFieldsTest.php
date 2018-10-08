<?php
namespace lib\Elastica\Test;

use Enalquiler\Elastica\ScriptFields as LegacyScriptFields;
use Enalquiler\Elastica\Test\Base as BaseTest;

class LegacyScriptFieldsTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testParent()
    {
        $this->assertInstanceOf('Enalquiler\Elastica\Script\ScriptFields', new LegacyScriptFields([]));
    }
}
