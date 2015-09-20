<?php

namespace Eqrepo\Converter;

use DateTime;
use Eqrepo\Parser\SearchParams;
use Helper\TestHelper;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * Class SearchParamsToArrayConverterTest
 * @package Eqrepo\Converter
 */
class SearchParamsToArrayConverterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SearchParamsToArrayConverter|PHPUnit_Framework_MockObject_MockObject
     */
    private $converter;

    public function setUp()
    {
        $this->converter = new SearchParamsToArrayConverter();
    }

    public function testGetValidDate_shouldReturnFalseIfDateIsNull()
    {
        $date = TestHelper::invokeMethod($this->converter, 'getValidDate', [null]);
        $this->assertEquals(false, $date);
    }

    public function testGetValidDate_shouldReturnFalseIfDateHasWrongFormat()
    {
        $date = TestHelper::invokeMethod($this->converter, 'getValidDate', ['wrong-format-date']);
        $this->assertEquals(false, $date);
    }

    public function testGetValidDate_shouldReturnValidDateIfArgumentIsDate()
    {
        /** @var DateTime $date */
        $date = TestHelper::invokeMethod($this->converter, 'getValidDate', ['1991-03-21 12:45:38']);

        $year = $date->format('Y');
        $month = $date->format('m');
        $day = $date->format('d');
        $hour = $date->format('H');
        $minute = $date->format('i');
        $second = $date->format('s');

        $this->assertEquals('1991', $year);
        $this->assertEquals('03', $month);
        $this->assertEquals('21', $day);
        $this->assertEquals('12', $hour);
        $this->assertEquals('45', $minute);
        $this->assertEquals('38', $second);
    }

    public function testPopulateStartTime_shouldPopulateArrayIfDateIsValid()
    {
        $this->converter = $this->getMockBuilder('\Eqrepo\Converter\SearchParamsToArrayConverter')
            ->setMethods(['getValidDate'])
            ->getMock();

        $validDate = new DateTime();
        $validDate->setDate(1991, 3, 21)->setTime(12, 45, 18);
        $this->converter->method('getValidDate')->willReturn($validDate);

        $result = [];
        TestHelper::invokeMethod($this->converter, 'populateStartTime', [&$result, new SearchParams()]);
        $this->assertEquals('1991-03-21T12:45:18-0300', $result['starttime']);
    }

    public function testPopulateStartTime_shouldNotPopulateArrayIfDateIsNotValid()
    {
        $this->converter = $this->converter = $this->getMockBuilder('\Eqrepo\Converter\SearchParamsToArrayConverter')
            ->setMethods(['getValidDate'])
            ->getMock();
        $this->converter->method('getValidDate')->willReturn(false);

        $result = [];
        TestHelper::invokeMethod($this->converter, 'populateStartTime', [&$result, new SearchParams()]);
        $this->assertArrayNotHasKey('starttime', $result);
    }

    public function testPopulateEndTime_shouldPopulateArrayIfDateIsValid()
    {
        $this->converter = $this->getMockBuilder('\Eqrepo\Converter\SearchParamsToArrayConverter')
            ->setMethods(['getValidDate'])
            ->getMock();

        $validDate = new DateTime();
        $validDate->setDate(1991, 3, 21)->setTime(12, 45, 18);
        $this->converter->method('getValidDate')->willReturn($validDate);

        $result = [];
        TestHelper::invokeMethod($this->converter, 'populateEndTime', [&$result, new SearchParams()]);
        $this->assertEquals('1991-03-21T12:45:18-0300', $result['endtime']);
    }

    public function testPopulateEndTime_shouldNotPopulateArrayIfDateIsIncorrect()
    {
        $this->converter = $this->getMockBuilder('\Eqrepo\Converter\SearchParamsToArrayConverter')
            ->setMethods(['getValidDate'])
            ->getMock();
        $this->converter->method('getValidDate')->willReturn(false);

        $result = [];
        TestHelper::invokeMethod($this->converter, 'populateEndTime', [&$result, new SearchParams()]);
        $this->assertArrayNotHasKey('endtime', $result);
    }

    public function testPopulateMinLatitude_shouldPopulateArrayIfMinLatitudeSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        $searchParams->withMinLatitude(-10.5);
        TestHelper::invokeMethod($this->converter, 'populateMinLatitude', [&$result, $searchParams]);
        $this->assertEquals(-10.5, $result['minlatitude']);
    }

    public function testPopulateMinLatitude_shouldNotPopulateArrayIfMinLatitudeNotSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        TestHelper::invokeMethod($this->converter, 'populateMinLatitude', [&$result, $searchParams]);
        $this->assertArrayNotHasKey('minlatitude', $result);
    }

    public function testPopulateMaxLatitude_shouldPopulateArrayIfMaxLatitudeSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        $searchParams->withMaxLatitude(-10.5);
        TestHelper::invokeMethod($this->converter, 'populateMaxLatitude', [&$result, $searchParams]);
        $this->assertEquals(-10.5, $result['maxlatitude']);
    }

    public function testPopulateMaxLatitude_shouldNotPopulateArrayIfMaxLatitudeNotSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        TestHelper::invokeMethod($this->converter, 'populateMaxLatitude', [&$result, $searchParams]);
        $this->assertArrayNotHasKey('maxlatitude', $result);
    }

    public function testPopulateMinLongitude_shouldPopulateArrayIfMinLongitudeSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        $searchParams->withMinLongitude(-10.5);
        TestHelper::invokeMethod($this->converter, 'populateMinLongitude', [&$result, $searchParams]);
        $this->assertEquals(-10.5, $result['minlongitude']);
    }

    public function testPopulateMinLongitude_shouldNotPopulateArrayIfMinLongitudeNotSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        TestHelper::invokeMethod($this->converter, 'populateMinLongitude', [&$result, $searchParams]);
        $this->assertArrayNotHasKey('minlongitude', $result);
    }

    public function testPopulateMaxLongitude_shouldPopulateArrayIfMaxLongitudeSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        $searchParams->withMaxLongitude(-10.5);
        TestHelper::invokeMethod($this->converter, 'populateMaxLongitude', [&$result, $searchParams]);
        $this->assertEquals(-10.5, $result['maxlongitude']);
    }

    public function testPopulateMaxLongitude_shouldNotPopulateArrayIfMaxLongitudeNotSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        TestHelper::invokeMethod($this->converter, 'populateMaxLongitude', [&$result, $searchParams]);
        $this->assertArrayNotHasKey('maxlongitude', $result);
    }

    public function testPopulateMinMagnitude_shouldPopulateArrayIfMinMagnitudeSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        $searchParams->withMinMagnitude(2.5);
        TestHelper::invokeMethod($this->converter, 'populateMinMagnitude', [&$result, $searchParams]);
        $this->assertEquals(2.5, $result['minmagnitude']);
    }

    public function testPopulateMinMagnitude_shouldNotPopulateArrayIfMinMagnitudeNotSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        TestHelper::invokeMethod($this->converter, 'populateMinMagnitude', [&$result, $searchParams]);
        $this->assertArrayNotHasKey('minmagnitude', $result);
    }

    public function testPopulateMaxMagnitude_shouldPopulateArrayIfMaxMagnitudeSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        $searchParams->withMaxMagnitude(2.5);
        TestHelper::invokeMethod($this->converter, 'populateMaxMagnitude', [&$result, $searchParams]);
        $this->assertEquals(2.5, $result['maxmagnitude']);
    }

    public function testPopulateMaxMagnitude_shouldNotPopulateArrayIfMaxMagnitudeNotSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        TestHelper::invokeMethod($this->converter, 'populateMaxMagnitude', [&$result, $searchParams]);
        $this->assertArrayNotHasKey('maxmagnitude', $result);
    }

    public function testPopulateMinDepth_shouldPopulateArrayIfMinDepthSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        $searchParams->withMinDepth(-100.23);
        TestHelper::invokeMethod($this->converter, 'populateMinDepth', [&$result, $searchParams]);
        $this->assertEquals(-100.23, $result['mindepth']);
    }

    public function testPopulateMinDepth_shouldNotPopulateArrayIfMinDepthNotSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        TestHelper::invokeMethod($this->converter, 'populateMinDepth', [&$result, $searchParams]);
        $this->assertArrayNotHasKey('mindepth', $result);
    }

    public function testPopulateMaxDepth_shouldPopulateArrayIfMaxDepthSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        $searchParams->withMaxDepth(-100.23);
        TestHelper::invokeMethod($this->converter, 'populateMaxDepth', [&$result, $searchParams]);
        $this->assertEquals(-100.23, $result['maxdepth']);
    }

    public function testPopulateMaxDepth_shouldNotPopulateArrayIfMaxDepthNotSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        TestHelper::invokeMethod($this->converter, 'populateMaxDepth', [&$result, $searchParams]);
        $this->assertArrayNotHasKey('maxdepth', $result);
    }

    public function testPopulateOrder_shouldPopulateArrayIfOrderIsSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        $searchParams->withOrder(SearchParams::ORDER_MAG_ASC);
        TestHelper::invokeMethod($this->converter, 'populateOrder', [&$result, $searchParams]);
        $this->assertEquals(SearchParams::ORDER_MAG_ASC, $result['orderby']);
    }

    public function testPopulateOrder_shouldNotPopulateArrayIfOrderNotSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        TestHelper::invokeMethod($this->converter, 'populateOrder', [&$result, $searchParams]);
        $this->assertArrayNotHasKey('orderby', $result);
    }

    public function testPopulateLimit_shouldPopulateArrayIfLimitIsSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        $searchParams->withLimit(10);
        TestHelper::invokeMethod($this->converter, 'populateLimit', [&$result, $searchParams]);
        $this->assertEquals(10, $result['limit']);
    }

    public function testPopulateLimit_shouldNotPopulateArrayIfLimitNotSet()
    {
        $result = [];
        $searchParams = new SearchParams();
        TestHelper::invokeMethod($this->converter, 'populateLimit', [&$result, $searchParams]);
        $this->assertArrayNotHasKey('limit', $result);
    }

    public function testConvert_shouldReturnValidArray()
    {
        $searchParams = new SearchParams();
        $searchParams->withStartTime('1991-03-21 12:45:18')
            ->withEndTime('2001-04-25 23:59:59')
            ->withMinLatitude(-0.5)
            ->withMaxLatitude(0.5)
            ->withMinLongitude(-1.2)
            ->withMaxLongitude(1.2)
            ->withMinMagnitude(2.8)
            ->withMaxMagnitude(7.3)
            ->withMinDepth(-500)
            ->withMaxDepth(1200)
            ->withOrder(SearchParams::ORDER_TIME_ASC)
            ->withLimit(5);
        $result = $this->converter->convert($searchParams);
        $expectedResult = [
            'starttime' => '1991-03-21T12:45:18-0300',
            'endtime' => '2001-04-25T23:59:59-0300',
            'minlatitude' => -0.5,
            'maxlatitude' => 0.5,
            'minlongitude' => -1.2,
            'maxlongitude' => 1.2,
            'minmagnitude' => 2.8,
            'maxmagnitude' => 7.3,
            'mindepth' => -500,
            'maxdepth' => 1200,
            'orderby' => SearchParams::ORDER_TIME_ASC,
            'limit' => 5
        ];
        $this->assertEquals($expectedResult, $result);
    }
}