<?php
namespace lib\Elastica\Test;

use Enalquiler\Elastica\ScriptFile as LegacyScriptFile;
use Enalquiler\Elastica\Test\Base as BaseTest;

class LegacyScriptFileTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testParent()
    {
        $this->assertInstanceOf('Enalquiler\Elastica\Script\ScriptFile', new LegacyScriptFile('script_file'));
    }
}
