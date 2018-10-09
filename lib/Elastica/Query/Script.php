<?php
namespace Enalquiler\Elastica\Query;

use Enalquiler\Elastica;

/**
 * Script query.
 *
 * @author Nicolas Ruflin <spam@ruflin.com>
 *
 * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-script-query.html
 */
class Script extends AbstractQuery
{
    /**
     * Construct script query.
     *
     * @param array|string|\Enalquiler\Elastica\Script\AbstractScript $script OPTIONAL Script
     */
    public function __construct($script = null)
    {
        if ($script) {
            $this->setScript($script);
        }
    }

    /**
     * Sets script object.
     *
     * @param \Enalquiler\Elastica\Script\Script|string|array $script
     *
     * @return $this
     */
    public function setScript($script)
    {
        return $this->setParam('script', Elastica\Script\Script::create($script));
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $array = parent::toArray();

        if (isset($array['script'])) {
            $array['script'] = $array['script']['script'];
        }

        return $array;
    }
}
