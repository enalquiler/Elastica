<?php
namespace Enalquiler\Elastica\Test\QueryBuilder\DSL;

use Enalquiler\Elastica\Filter\Exists;
use Enalquiler\Elastica\Query\Term;
use Enalquiler\Elastica\QueryBuilder\DSL;

class AggregationTest extends AbstractDSLTest
{
    /**
     * @group unit
     */
    public function testType()
    {
        $aggregationDSL = new DSL\Aggregation();

        $this->assertInstanceOf('Enalquiler\Elastica\QueryBuilder\DSL', $aggregationDSL);
        $this->assertEquals(DSL::TYPE_AGGREGATION, $aggregationDSL->getType());
    }

    /**
     * @group unit
     * @expectedException \Enalquiler\Elastica\Exception\InvalidException
     */
    public function testFilteredInvalid()
    {
        $queryDSL = new DSL\Aggregation();
        $queryDSL->filter(null, $this);
    }

    /**
     * @group unit
     */
    public function testInterface()
    {
        $aggregationDSL = new DSL\Aggregation();

        $this->_assertImplemented($aggregationDSL, 'avg', 'Enalquiler\Elastica\Aggregation\Avg', ['name']);
        $this->_assertImplemented($aggregationDSL, 'cardinality', 'Enalquiler\Elastica\Aggregation\Cardinality', ['name']);
        $this->_assertImplemented($aggregationDSL, 'date_histogram', 'Enalquiler\Elastica\Aggregation\DateHistogram', ['name', 'field', 1]);
        $this->_assertImplemented($aggregationDSL, 'date_range', 'Enalquiler\Elastica\Aggregation\DateRange', ['name']);
        $this->_assertImplemented($aggregationDSL, 'extended_stats', 'Enalquiler\Elastica\Aggregation\ExtendedStats', ['name']);
        $this->hideDeprecated();
        $this->_assertImplemented($aggregationDSL, 'filter', 'Enalquiler\Elastica\Aggregation\Filter', ['name', new Exists('field')]);
        $this->showDeprecated();

        $this->_assertImplemented($aggregationDSL, 'filter', 'Enalquiler\Elastica\Aggregation\Filter', ['name', new Term()]);

        $this->_assertImplemented($aggregationDSL, 'filters', 'Enalquiler\Elastica\Aggregation\Filters', ['name']);
        $this->_assertImplemented($aggregationDSL, 'geo_distance', 'Enalquiler\Elastica\Aggregation\GeoDistance', ['name', 'field', 'origin']);
        $this->_assertImplemented($aggregationDSL, 'geohash_grid', 'Enalquiler\Elastica\Aggregation\GeohashGrid', ['name', 'field']);
        $this->_assertImplemented($aggregationDSL, 'global_agg', 'Enalquiler\Elastica\Aggregation\GlobalAggregation', ['name']);
        $this->_assertImplemented($aggregationDSL, 'histogram', 'Enalquiler\Elastica\Aggregation\Histogram', ['name', 'field', 1]);
        $this->_assertImplemented($aggregationDSL, 'ipv4_range', 'Enalquiler\Elastica\Aggregation\IpRange', ['name', 'field']);
        $this->_assertImplemented($aggregationDSL, 'max', 'Enalquiler\Elastica\Aggregation\Max', ['name']);
        $this->_assertImplemented($aggregationDSL, 'min', 'Enalquiler\Elastica\Aggregation\Min', ['name']);
        $this->_assertImplemented($aggregationDSL, 'missing', 'Enalquiler\Elastica\Aggregation\Missing', ['name', 'field']);
        $this->_assertImplemented($aggregationDSL, 'nested', 'Enalquiler\Elastica\Aggregation\Nested', ['name', 'path']);
        $this->_assertImplemented($aggregationDSL, 'percentiles', 'Enalquiler\Elastica\Aggregation\Percentiles', ['name']);
        $this->_assertImplemented($aggregationDSL, 'range', 'Enalquiler\Elastica\Aggregation\Range', ['name']);
        $this->_assertImplemented($aggregationDSL, 'reverse_nested', 'Enalquiler\Elastica\Aggregation\ReverseNested', ['name']);
        $this->_assertImplemented($aggregationDSL, 'scripted_metric', 'Enalquiler\Elastica\Aggregation\ScriptedMetric', ['name']);
        $this->_assertImplemented($aggregationDSL, 'significant_terms', 'Enalquiler\Elastica\Aggregation\SignificantTerms', ['name']);
        $this->_assertImplemented($aggregationDSL, 'stats', 'Enalquiler\Elastica\Aggregation\Stats', ['name']);
        $this->_assertImplemented($aggregationDSL, 'sum', 'Enalquiler\Elastica\Aggregation\Sum', ['name']);
        $this->_assertImplemented($aggregationDSL, 'terms', 'Enalquiler\Elastica\Aggregation\Terms', ['name']);
        $this->_assertImplemented($aggregationDSL, 'top_hits', 'Enalquiler\Elastica\Aggregation\TopHits', ['name']);
        $this->_assertImplemented($aggregationDSL, 'value_count', 'Enalquiler\Elastica\Aggregation\ValueCount', ['name', 'field']);
        $this->_assertImplemented($aggregationDSL, 'bucket_script', 'Enalquiler\Elastica\Aggregation\BucketScript', ['name']);
        $this->_assertImplemented($aggregationDSL, 'serial_diff', 'Enalquiler\Elastica\Aggregation\SerialDiff', ['name']);

        $this->_assertNotImplemented($aggregationDSL, 'children', ['name']);
        $this->_assertNotImplemented($aggregationDSL, 'geo_bounds', ['name']);
        $this->_assertNotImplemented($aggregationDSL, 'percentile_ranks', ['name']);
    }
}
