<?php
namespace Enalquiler\Elastica\Test;

use Enalquiler\Elastica\Exception\NotImplementedException;
use Enalquiler\Elastica\Filter\BoolFilter;
use Enalquiler\Elastica\Suggest;
use Enalquiler\Elastica\Test\Base as BaseTest;

class SuggestTest extends BaseTest
{
    /**
     * Create self test.
     *
     * @group functional
     */
    public function testCreateSelf()
    {
        $suggest = new Suggest();

        $selfSuggest = Suggest::create($suggest);

        $this->assertSame($suggest, $selfSuggest);
    }

    /**
     * Create with suggest test.
     *
     * @group functional
     */
    public function testCreateWithSuggest()
    {
        $suggest1 = new Suggest\Term('suggest1', '_all');

        $suggest = Suggest::create($suggest1);

        $this->assertTrue($suggest->hasParam('suggestion'));
    }

    /**
     * Create with non suggest test.
     *
     * @group functional
     */
    public function testCreateWithNonSuggest()
    {
        try {
            Suggest::create(new BoolFilter());
            $this->fail();
        } catch (NotImplementedException $e) {
        }
    }
}
