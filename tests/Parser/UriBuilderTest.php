<?php

namespace Eqrepo\Parser;

use PHPUnit_Framework_TestCase;

/**
 * Class UriBuilderTest
 * @package Eqrepo\Parser
 */
class UriBuilderTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var UriBuilder
     */
    private $uriBuilder;

    public function setUp()
    {
        $this->uriBuilder = new UriBuilder();
    }

    public function testBuildUri_shouldBuildCorrectUri()
    {
        $searchParams = new SearchParams();
        $searchParams->withStartTime('2000-03-21 12:45:18')
            ->withEndTime('2000-03-22 12:45:18')
            ->withMinLatitude(-90)
            ->withMaxLatitude(90)
            ->withMinLongitude(-180)
            ->withMaxLongitude(180)
            ->withMinMagnitude(0)
            ->withMaxMagnitude(10)
            ->withMinDepth(-100)
            ->withMaxDepth(1000)
            ->withOrder(SearchParams::ORDER_TIME_ASC)
            ->withLimit(10);
        $uri = $this->uriBuilder->buildUri($searchParams);
        $this->assertEquals(
            'http://earthquake.usgs.gov/fdsnws/event/1/query?starttime=2000-03-21T12%3A45%3A18-0300&endtime=2000-03-22T12%3A45%3A18-0300&minlatitude=-90&maxlatitude=90&minlongitude=-180&maxlongitude=180&minmagnitude=0&maxmagnitude=10&mindepth=-100&maxdepth=1000&orderby=time-asc&limit=10',
            $uri
        );
    }
}