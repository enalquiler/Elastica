<?php
namespace Enalquiler\Elastica\Test\Query;

use Enalquiler\Elastica\Query\Builder;
use Enalquiler\Elastica\Test\Base as BaseTest;

class BuilderTest extends BaseTest
{
    /**
     * @group unit
     */
    public function testDeprecated()
    {
        $this->hideDeprecated();
        $reflection = new \ReflectionClass(new Builder());
        $this->showDeprecated();

        $this->assertFileDeprecated($reflection->getFileName(), 'This builder is deprecated and will be removed in further Elastica releases. Use new Elastica\QueryBuilder instead.');
    }

    /**
     * @group unit
     * @covers \Enalquiler\Elastica\Query\Builder::factory
     * @covers \Enalquiler\Elastica\Query\Builder::__construct
     */
    public function testFactory()
    {
        $this->assertInstanceOf(
            'Enalquiler\Elastica\Query\Builder',
            Builder::factory('some string')
        );
    }

    public function getQueryData()
    {
        return [
            ['allowLeadingWildcard', false, '{"allow_leading_wildcard":"false"}'],
            ['allowLeadingWildcard', true, '{"allow_leading_wildcard":"true"}'],
            ['analyzeWildcard', false, '{"analyze_wildcard":"false"}'],
            ['analyzeWildcard', true, '{"analyze_wildcard":"true"}'],
            ['analyzer', 'someAnalyzer', '{"analyzer":"someAnalyzer"}'],
            ['autoGeneratePhraseQueries', true, '{"auto_generate_phrase_queries":"true"}'],
            ['autoGeneratePhraseQueries', false, '{"auto_generate_phrase_queries":"false"}'],
            ['boost', 2, '{"boost":"2"}'],
            ['boost', 4.2, '{"boost":"4.2"}'],
            ['defaultField', 'fieldName', '{"default_field":"fieldName"}'],
            ['defaultOperator', 'OR', '{"default_operator":"OR"}'],
            ['defaultOperator', 'AND', '{"default_operator":"AND"}'],
            ['enablePositionIncrements', true, '{"enable_position_increments":"true"}'],
            ['enablePositionIncrements', false, '{"enable_position_increments":"false"}'],
            ['explain', true, '{"explain":"true"}'],
            ['explain', false, '{"explain":"false"}'],
            ['from', 42, '{"from":"42"}'],
            ['fuzzyMinSim', 4.2, '{"fuzzy_min_sim":"4.2"}'],
            ['fuzzyPrefixLength', 2, '{"fuzzy_prefix_length":"2"}'],
            ['gt', 10, '{"gt":"10"}'],
            ['gte', 11, '{"gte":"11"}'],
            ['lowercaseExpandedTerms', true, '{"lowercase_expanded_terms":"true"}'],
            ['lt', 10, '{"lt":"10"}'],
            ['lte', 11, '{"lte":"11"}'],
            ['minimumNumberShouldMatch', 21, '{"minimum_number_should_match":"21"}'],
            ['phraseSlop', 6, '{"phrase_slop":"6"}'],
            ['size', 7, '{"size":"7"}'],
            ['tieBreakerMultiplier', 7, '{"tie_breaker_multiplier":"7"}'],
            ['matchAll', 1.1, '{"match_all":{"boost":"1.1"}}'],
            ['fields', ['age', 'sex', 'location'], '{"fields":["age","sex","location"]}'],
        ];
    }

    /**
     * @group unit
     * @dataProvider getQueryData
     * @covers \Enalquiler\Elastica\Query\Builder::__toString
     * @covers \Enalquiler\Elastica\Query\Builder::allowLeadingWildcard
     * @covers \Enalquiler\Elastica\Query\Builder::analyzeWildcard
     * @covers \Enalquiler\Elastica\Query\Builder::analyzer
     * @covers \Enalquiler\Elastica\Query\Builder::autoGeneratePhraseQueries
     * @covers \Enalquiler\Elastica\Query\Builder::boost
     * @covers \Enalquiler\Elastica\Query\Builder::defaultField
     * @covers \Enalquiler\Elastica\Query\Builder::defaultOperator
     * @covers \Enalquiler\Elastica\Query\Builder::enablePositionIncrements
     * @covers \Enalquiler\Elastica\Query\Builder::explain
     * @covers \Enalquiler\Elastica\Query\Builder::from
     * @covers \Enalquiler\Elastica\Query\Builder::fuzzyMinSim
     * @covers \Enalquiler\Elastica\Query\Builder::fuzzyPrefixLength
     * @covers \Enalquiler\Elastica\Query\Builder::gt
     * @covers \Enalquiler\Elastica\Query\Builder::gte
     * @covers \Enalquiler\Elastica\Query\Builder::lowercaseExpandedTerms
     * @covers \Enalquiler\Elastica\Query\Builder::lt
     * @covers \Enalquiler\Elastica\Query\Builder::lte
     * @covers \Enalquiler\Elastica\Query\Builder::minimumNumberShouldMatch
     * @covers \Enalquiler\Elastica\Query\Builder::phraseSlop
     * @covers \Enalquiler\Elastica\Query\Builder::size
     * @covers \Enalquiler\Elastica\Query\Builder::tieBreakerMultiplier
     * @covers \Enalquiler\Elastica\Query\Builder::matchAll
     * @covers \Enalquiler\Elastica\Query\Builder::fields
     */
    public function testAllowLeadingWildcard($method, $argument, $result)
    {
        $builder = new Builder();
        $this->assertSame($builder, $builder->$method($argument));
        $this->assertSame($result, (string) $builder);
    }

    public function getQueryTypes()
    {
        return [
            ['bool', 'bool'],
            ['constantScore', 'constant_score'],
            ['disMax', 'dis_max'],
            ['filter', 'filter'],
            ['filteredQuery', 'filtered'],
            ['must', 'must'],
            ['mustNot', 'must_not'],
            ['prefix', 'prefix'],
            ['query', 'query'],
            ['queryString', 'query_string'],
            ['range', 'range'],
            ['should', 'should'],
            ['sort', 'sort'],
            ['term', 'term'],
            ['textPhrase', 'text_phrase'],
            ['wildcard', 'wildcard'],
        ];
    }

    /**
     * @group unit
     * @dataProvider getQueryTypes
     * @covers \Enalquiler\Elastica\Query\Builder::fieldClose
     * @covers \Enalquiler\Elastica\Query\Builder::close
     * @covers \Enalquiler\Elastica\Query\Builder::bool
     * @covers \Enalquiler\Elastica\Query\Builder::boolClose
     * @covers \Enalquiler\Elastica\Query\Builder::constantScore
     * @covers \Enalquiler\Elastica\Query\Builder::constantScoreClose
     * @covers \Enalquiler\Elastica\Query\Builder::disMax
     * @covers \Enalquiler\Elastica\Query\Builder::disMaxClose
     * @covers \Enalquiler\Elastica\Query\Builder::filter
     * @covers \Enalquiler\Elastica\Query\Builder::filterClose
     * @covers \Enalquiler\Elastica\Query\Builder::filteredQuery
     * @covers \Enalquiler\Elastica\Query\Builder::filteredQueryClose
     * @covers \Enalquiler\Elastica\Query\Builder::must
     * @covers \Enalquiler\Elastica\Query\Builder::mustClose
     * @covers \Enalquiler\Elastica\Query\Builder::mustNot
     * @covers \Enalquiler\Elastica\Query\Builder::mustNotClose
     * @covers \Enalquiler\Elastica\Query\Builder::prefix
     * @covers \Enalquiler\Elastica\Query\Builder::prefixClose
     * @covers \Enalquiler\Elastica\Query\Builder::query
     * @covers \Enalquiler\Elastica\Query\Builder::queryClose
     * @covers \Enalquiler\Elastica\Query\Builder::queryString
     * @covers \Enalquiler\Elastica\Query\Builder::queryStringClose
     * @covers \Enalquiler\Elastica\Query\Builder::range
     * @covers \Enalquiler\Elastica\Query\Builder::rangeClose
     * @covers \Enalquiler\Elastica\Query\Builder::should
     * @covers \Enalquiler\Elastica\Query\Builder::shouldClose
     * @covers \Enalquiler\Elastica\Query\Builder::sort
     * @covers \Enalquiler\Elastica\Query\Builder::sortClose
     * @covers \Enalquiler\Elastica\Query\Builder::term
     * @covers \Enalquiler\Elastica\Query\Builder::termClose
     * @covers \Enalquiler\Elastica\Query\Builder::textPhrase
     * @covers \Enalquiler\Elastica\Query\Builder::textPhraseClose
     * @covers \Enalquiler\Elastica\Query\Builder::wildcard
     * @covers \Enalquiler\Elastica\Query\Builder::wildcardClose
     */
    public function testQueryTypes($method, $queryType)
    {
        $builder = new Builder();
        $this->assertSame($builder, $builder->$method()); // open
        $this->assertSame($builder, $builder->{$method.'Close'}()); // close
        $this->assertSame('{"'.$queryType.'":{}}', (string) $builder);
    }

    /**
     * @group unit
     * @covers \Enalquiler\Elastica\Query\Builder::fieldOpen
     * @covers \Enalquiler\Elastica\Query\Builder::fieldClose
     * @covers \Enalquiler\Elastica\Query\Builder::open
     * @covers \Enalquiler\Elastica\Query\Builder::close
     */
    public function testFieldOpenAndClose()
    {
        $builder = new Builder();
        $this->assertSame($builder, $builder->fieldOpen('someField'));
        $this->assertSame($builder, $builder->fieldClose());
        $this->assertSame('{"someField":{}}', (string) $builder);
    }

    /**
     * @group unit
     * @covers \Enalquiler\Elastica\Query\Builder::sortField
     */
    public function testSortField()
    {
        $builder = new Builder();
        $this->assertSame($builder, $builder->sortField('name', true));
        $this->assertSame('{"sort":{"name":{"reverse":"true"}}}', (string) $builder);
    }

    /**
     * @group unit
     * @covers \Enalquiler\Elastica\Query\Builder::sortFields
     */
    public function testSortFields()
    {
        $builder = new Builder();
        $this->assertSame($builder, $builder->sortFields(['field1' => 'asc', 'field2' => 'desc', 'field3' => 'asc']));
        $this->assertSame('{"sort":[{"field1":"asc"},{"field2":"desc"},{"field3":"asc"}]}', (string) $builder);
    }

    /**
     * @group unit
     * @covers \Enalquiler\Elastica\Query\Builder::queries
     */
    public function testQueries()
    {
        $queries = [];

        $builder = new Builder();
        $b1 = clone $builder;
        $b2 = clone $builder;

        $queries[] = $b1->term()->field('age', 34)->termClose();
        $queries[] = $b2->term()->field('name', 'christer')->termClose();

        $this->assertSame($builder, $builder->queries($queries));
        $this->assertSame('{"queries":[{"term":{"age":"34"}},{"term":{"name":"christer"}}]}', (string) $builder);
    }

    public function getFieldData()
    {
        return [
            ['name', 'value', '{"name":"value"}'],
            ['name', true, '{"name":"true"}'],
            ['name', false, '{"name":"false"}'],
            ['name', [1, 2, 3], '{"name":["1","2","3"]}'],
            ['name', ['foo', 'bar', 'baz'], '{"name":["foo","bar","baz"]}'],
        ];
    }

    /**
     * @group unit
     * @dataProvider getFieldData
     * @covers \Enalquiler\Elastica\Query\Builder::field
     */
    public function testField($name, $value, $result)
    {
        $builder = new Builder();
        $this->assertSame($builder, $builder->field($name, $value));
        $this->assertSame($result, (string) $builder);
    }

    /**
     * @group unit
     * @expectedException \Enalquiler\Elastica\Exception\InvalidException
     * @expectedExceptionMessage The produced query is not a valid json string : "{{}"
     * @covers \Enalquiler\Elastica\Query\Builder::toArray
     */
    public function testToArrayWithInvalidData()
    {
        $builder = new Builder();
        $builder->open('foo');
        $builder->toArray();
    }

    /**
     * @group unit
     * @covers \Enalquiler\Elastica\Query\Builder::toArray
     */
    public function testToArray()
    {
        $builder = new Builder();
        $builder->query()->term()->field('category.id', [1, 2, 3])->termClose()->queryClose();
        $expected = [
            'query' => [
                'term' => [
                    'category.id' => [1, 2, 3],
                ],
            ],
        ];
        $this->assertEquals($expected, $builder->toArray());
    }
}
