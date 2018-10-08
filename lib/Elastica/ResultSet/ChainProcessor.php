<?php
namespace Enalquiler\Elastica\ResultSet;

use Enalquiler\Elastica\ResultSet;

/**
 * Allows multiple ProcessorInterface instances to operate on the same
 * ResultSet, calling each in turn.
 */
class ChainProcessor implements ProcessorInterface
{
    /**
     * @var ProcessorInterface[]
     */
    private $processors;

    /**
     * @param ProcessorInterface[] $processors
     */
    public function __construct($processors)
    {
        $this->processors = $processors;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ResultSet $resultSet)
    {
        foreach ($this->processors as $processor) {
            $processor->process($resultSet);
        }
    }
}
