<?php
namespace Enalquiler\Elastica\Test\QueryBuilder\DSL;

use Enalquiler\Elastica\Filter\Exists;
use Enalquiler\Elastica\Query\Match;
use Enalquiler\Elastica\QueryBuilder\DSL;

class FilterTest extends AbstractDSLTest
{
    /**
     * @group unit
     */
    public function testType()
    {
        $filterDSL = new DSL\Filter();

        $this->assertInstanceOf('Enalquiler\Elastica\QueryBuilder\DSL', $filterDSL);
        $this->assertEquals(DSL::TYPE_FILTER, $filterDSL->getType());
    }

    /**
     * @group unit
     */
    public function testInterface()
    {
        $filterDSL = new DSL\Filter();

        $this->hideDeprecated();

        $this->_assertImplemented($filterDSL, 'bool', 'Enalquiler\Elastica\Filter\BoolFilter', []);
        $this->_assertImplemented($filterDSL, 'bool_and', 'Enalquiler\Elastica\Filter\BoolAnd', [[new Exists('field')]]);
        $this->_assertImplemented($filterDSL, 'bool_not', 'Enalquiler\Elastica\Filter\BoolNot', [new Exists('field')]);
        $this->_assertImplemented($filterDSL, 'bool_or', 'Enalquiler\Elastica\Filter\BoolOr', [[new Exists('field')]]);
        $this->_assertImplemented($filterDSL, 'exists', 'Enalquiler\Elastica\Filter\Exists', ['field']);
        $this->_assertImplemented($filterDSL, 'geo_bounding_box', 'Enalquiler\Elastica\Filter\GeoBoundingBox', ['field', [1, 2]]);
        $this->_assertImplemented($filterDSL, 'geo_distance', 'Enalquiler\Elastica\Filter\GeoDistance', ['key', 'location', 'distance']);
        $this->_assertImplemented($filterDSL, 'geo_distance_range', 'Enalquiler\Elastica\Filter\GeoDistanceRange', ['key', 'location']);
        $this->_assertImplemented($filterDSL, 'geo_polygon', 'Enalquiler\Elastica\Filter\GeoPolygon', ['key', []]);
        $this->_assertImplemented($filterDSL, 'geo_shape_pre_indexed', 'Enalquiler\Elastica\Filter\GeoShapePreIndexed', ['path', 'indexedId', 'indexedType', 'indexedIndex', 'indexedPath']);
        $this->_assertImplemented($filterDSL, 'geo_shape_provided', 'Enalquiler\Elastica\Filter\GeoShapeProvided', ['path', []]);
        $this->_assertImplemented($filterDSL, 'geohash_cell', 'Enalquiler\Elastica\Filter\GeohashCell', ['field', 'location']);
        $this->_assertImplemented($filterDSL, 'has_child', 'Enalquiler\Elastica\Filter\HasChild', [new Match(), 'type']);
        $this->_assertImplemented($filterDSL, 'has_parent', 'Enalquiler\Elastica\Filter\HasParent', [new Match(), 'type']);
        $this->_assertImplemented($filterDSL, 'ids', 'Enalquiler\Elastica\Filter\Ids', ['type', []]);
        $this->_assertImplemented($filterDSL, 'indices', 'Enalquiler\Elastica\Filter\Indices', [new Exists('field'), []]);
        $this->_assertImplemented($filterDSL, 'limit', 'Enalquiler\Elastica\Filter\Limit', [1]);
        $this->_assertImplemented($filterDSL, 'match_all', 'Enalquiler\Elastica\Filter\MatchAll', []);
        $this->_assertImplemented($filterDSL, 'missing', 'Enalquiler\Elastica\Filter\Missing', ['field']);
        $this->_assertImplemented($filterDSL, 'nested', 'Enalquiler\Elastica\Filter\Nested', []);
        $this->_assertImplemented($filterDSL, 'numeric_range', 'Enalquiler\Elastica\Filter\NumericRange', []);
        $this->_assertImplemented($filterDSL, 'prefix', 'Enalquiler\Elastica\Filter\Prefix', ['field', 'prefix']);
        $this->_assertImplemented($filterDSL, 'query', 'Enalquiler\Elastica\Filter\Query', [new Match()]);
        $this->_assertImplemented($filterDSL, 'range', 'Enalquiler\Elastica\Filter\Range', ['field', []]);
        $this->_assertImplemented($filterDSL, 'regexp', 'Enalquiler\Elastica\Filter\Regexp', ['field', 'regex']);
        $this->_assertImplemented($filterDSL, 'script', 'Enalquiler\Elastica\Filter\Script', ['script']);
        $this->_assertImplemented($filterDSL, 'term', 'Enalquiler\Elastica\Filter\Term', []);
        $this->_assertImplemented($filterDSL, 'terms', 'Enalquiler\Elastica\Filter\Terms', ['field', []]);
        $this->_assertImplemented($filterDSL, 'type', 'Enalquiler\Elastica\Filter\Type', ['type']);
        $this->showDeprecated();
    }
}
