<?php
namespace Enalquiler\Elastica\ResultSet;

use Enalquiler\Elastica\ResultSet;

interface ProcessorInterface
{
    /**
     * Iterates over a ResultSet allowing a processor to iterate over any
     * Results as required.
     *
     * @param ResultSet $resultSet
     */
    public function process(ResultSet $resultSet);
}
