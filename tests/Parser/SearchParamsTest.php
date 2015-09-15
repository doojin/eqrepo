<?php

namespace Eqrepo\Parser;

use PHPUnit_Framework_TestCase;

/**
 * Class SearchParamsTest
 * @package Eqrepo\Parser
 */
class SearchParamsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SearchParams
     */
    private $searchParams;

    public function setUp()
    {
        $this->searchParams = new SearchParams();
    }

    public function testWithStartTime_shouldSetStartTime()
    {
        $startTime = $this->searchParams->withStartTime('1991-03-21')->getStartTime();
        $this->assertEquals('1991-03-21', $startTime);
    }

    public function testWithEndTime_shouldSetEndTime()
    {
        $endTime = $this->searchParams->withEndTime('1991-03-21')->getEndTime();
        $this->assertEquals('1991-03-21', $endTime);
    }

    public function testWithMinLatitude_shouldSetMinLatitude()
    {
        $minLatitude = $this->searchParams->withMinLatitude(-1.5)->getMinLatitude();
        $this->assertEquals(-1.5, $minLatitude);
    }

    public function testWithMaxLatitude_shouldSetMaxLatitude()
    {
        $maxLatitude = $this->searchParams->withMaxLatitude(2.8)->getMaxLatitude();
        $this->assertEquals(2.8, $maxLatitude);
    }

    public function testWithMinLongitude_shouldSetMinLongitude()
    {
        $minLongitude = $this->searchParams->withMinLongitude(-1.5)->getMinLongitude();
        $this->assertEquals(-1.5, $minLongitude);
    }

    public function testWithMaxLongitude_shouldSetMaxLongitude()
    {
        $maxLongitude = $this->searchParams->withMaxLongitude(2.8)->getMaxLongitude();
        $this->assertEquals(2.8, $maxLongitude);
    }

    public function testWithMinMagnitude_shouldSetMinMagnitude()
    {
        $minMagnitude = $this->searchParams->withMinMagnitude(1.4)->getMinMagnitude();
        $this->assertEquals(1.4, $minMagnitude);
    }

    public function testWithMaxMagnitude_shouldSetMaxMagnitude()
    {
        $maxMagnitude = $this->searchParams->withMaxMagnitude(5.8)->getMaxMagnitude();
        $this->assertEquals(5.8, $maxMagnitude);
    }

    public function testWithMinDepth_shouldSetMinDepth()
    {
        $minDepth = $this->searchParams->withMinDepth(-500)->getMinDepth();
        $this->assertEquals(-500, $minDepth);
    }

    public function testWithMaxDepth_shouldSetMaxDepth()
    {
        $maxDepth = $this->searchParams->withMaxDepth(500)->getMaxDepth();
        $this->assertEquals(500, $maxDepth);
    }

    public function testWithOrder_shouldSetOrderBy()
    {
        $orderBy = $this->searchParams->withOrder(SearchParams::ORDER_TIME_DESC)->getOrderBy();
        $this->assertEquals(SearchParams::ORDER_TIME_DESC, $orderBy);
    }

    public function testWithLimit_shouldSetLimit()
    {
        $limit = $this->searchParams->withLimit(5)->getLimit();
        $this->assertEquals(5, $limit);
    }
}