<?php

namespace Eqrepo\Converter;

use Eqrepo\Model\Earthquake;
use Helper\TestHelper;
use PHPUnit_Framework_TestCase;
use SimpleXMLElement;

/**
 * Class XmlToEarthquakeArrayConverterTest
 * @package Eqrepo\Converter
 */
class XmlToEarthquakeArrayConverterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var XmlToEarthquakeArrayConverter
     */
    private $converter;

    public function setUp()
    {
        $this->converter = new XmlToEarthquakeArrayConverter();
    }

    public function testExtractDescription_shouldReturnDescriptionIfSet()
    {
        $earthquakeXml = new SimpleXMLElement('<earthquake></earthquake>');
        $earthquakeXml
            ->addChild('description')
            ->addChild('text', 'dummy description');
        $result = TestHelper::invokeMethod($this->converter, 'extractDescription', [$earthquakeXml]);
        $this->assertEquals('dummy description', $result);
    }

    public function testExtractDescription_shouldReturnNullIfDescriptionNotSet()
    {
        $earthquakeXml = new SimpleXMLElement('<earthquake></earthquake>');
        $result = TestHelper::invokeMethod($this->converter, 'extractDescription', [$earthquakeXml]);
        $this->assertNull($result);
    }

    public function testExtractTime_shouldReturnTimeIfSet()
    {
        $earthquakeXml = new SimpleXMLElement('<earthquake></earthquake>');
        $earthquakeXml
            ->addChild('origin')
            ->addChild('time')
            ->addChild('value', '12:24');
        $result = TestHelper::invokeMethod($this->converter, 'extractTime', [$earthquakeXml]);
        $this->assertEquals('12:24', $result);
    }

    public function testExtractTime_shouldReturnNullIfTimeNotSet()
    {
        $earthquakeXml = new SimpleXMLElement('<earthquake></earthquake>');
        $result = TestHelper::invokeMethod($this->converter, 'extractTime', [$earthquakeXml]);
        $this->assertNull($result);
    }

    public function testExtractLongitude_shouldReturnLongitudeIfSet()
    {
        $earthquakeXml = new SimpleXMLElement('<earthquake></earthquake>');
        $earthquakeXml
            ->addChild('origin')
            ->addChild('longitude')
            ->addChild('value', '-12.3322');
        $result = TestHelper::invokeMethod($this->converter, 'extractLongitude', [$earthquakeXml]);
        $this->assertEquals('-12.3322', $result);
    }

    public function testExtractLongitude_shouldReturnNullIfLongitudeNotSet()
    {
        $earthquakeXml = new SimpleXMLElement('<earthquake></earthquake>');
        $result = TestHelper::invokeMethod($this->converter, 'extractLongitude', [$earthquakeXml]);
        $this->assertNull($result);
    }

    public function testExtractLatitude_shouldReturnLatitudeIfSet()
    {
        $earthquakeXml = new SimpleXMLElement('<earthquake></earthquake>');
        $earthquakeXml
            ->addChild('origin')
            ->addChild('latitude')
            ->addChild('value', '2.826');
        $result = TestHelper::invokeMethod($this->converter, 'extractLatitude', [$earthquakeXml]);
        $this->assertEquals('2.826', $result);
    }

    public function testExtractLatitude_shouldReturnNullifLatitudeNotSet()
    {
        $earthquakeXml = new SimpleXMLElement('<earthquake></earthquake>');
        $result = TestHelper::invokeMethod($this->converter, 'extractLatitude', [$earthquakeXml]);
        $this->assertNull($result);
    }

    public function testExtractDepth_shouldReturnDepthIfSet()
    {
        $earthquakeXml = new SimpleXMLElement('<earthquake></earthquake>');
        $earthquakeXml
            ->addChild('origin')
            ->addChild('depth')
            ->addChild('value', '3000');
        $result = TestHelper::invokeMethod($this->converter, 'extractDepth', [$earthquakeXml]);
        $this->assertEquals('3000', $result);
    }

    public function testExtractDepth_shouldReturnNullIfDepthNotSet()
    {
        $earthquakeXml = new SimpleXMLElement('<earthquake></earthquake>');
        $result = TestHelper::invokeMethod($this->converter, 'extractDepth', [$earthquakeXml]);
        $this->assertNull($result);
    }

    public function testExtractMagnitude_shouldReturnMagnitudeIfSet()
    {
        $earthquakeXml = new SimpleXMLElement('<earthquake></earthquake>');
        $earthquakeXml
            ->addChild('magnitude')
            ->addChild('mag')
            ->addChild('value', '4.5');
        $result = TestHelper::invokeMethod($this->converter, 'extractMagnitude', [$earthquakeXml]);
        $this->assertEquals('4.5', $result);
    }

    public function testExtractMagnitude_shouldReturnNullIfMagnitudeNotSet()
    {
        $earthquakeXml = new SimpleXMLElement('<earthquake></earthquake>');
        $result = TestHelper::invokeMethod($this->converter, 'extractMagnitude', [$earthquakeXml]);
        $this->assertNull($result);
    }

    public function testExtractEarthquake_shouldExtractEarthquakeFromSimpleXMLElement()
    {
        $earthquakeXml = new SimpleXMLElement('<earthquake></earthquake>');
        $earthquakeXml
            ->addChild('description')
            ->addChild('text', 'dummy description');
        $origin = new SimpleXMLElement('<origin></origin>');
        $origin
            ->addChild('time')
            ->addChild('value', 'dummy time');
        $origin
            ->addChild('longitude')
            ->addChild('value', 'dummy longitude');
        $origin
            ->addChild('latitude')
            ->addChild('value', 'dummy latitude');
        $origin
            ->addChild('depth')
            ->addChild('value', 'dummy depth');
        $earthquakeXml
            ->addChild('magnitude')
            ->addChild('mag')
            ->addChild('value', 'dummy magnitude');
        // Appending origin to Earthquake
        $domEarthquake = dom_import_simplexml($earthquakeXml);
        $domOrigin = dom_import_simplexml($origin);
        $domOrigin = $domEarthquake->ownerDocument->importNode($domOrigin, true);
        $domEarthquake->appendChild($domOrigin);

        /** @var Earthquake $result */
        $result = TestHelper::invokeMethod($this->converter, 'extractEarthquake', [$earthquakeXml]);

        $this->assertEquals('dummy description', $result->getDescription());
        $this->assertEquals('dummy time', $result->getTime());
        $this->assertEquals('dummy longitude', $result->getLongitude());
        $this->assertEquals('dummy latitude', $result->getLatitude());
        $this->assertEquals('dummy depth', $result->getDepth());
        $this->assertEquals('dummy magnitude', $result->getMagnitude());
    }

    public function testConvert_shouldConvertXmlToArrayOfEarthquakes()
    {
        $xml = <<< DATA
<?xml version="1.0"?>
<q:quakeml xmlns="http://quakeml.org/xmlns/bed/1.2" xmlns:catalog="http://anss.org/xmlns/catalog/0.1" xmlns:q="http://quakeml.org/xmlns/quakeml/1.2">
<eventParameters publicID="quakeml:earthquake.usgs.gov/fdsnws/event/1/query?starttime=2000-03-21T12%3A45%3A18-0300&amp;endtime=2000-03-22T12%3A45%3A18-0300&amp;minlatitude=-90&amp;maxlatitude=90&amp;minlongitude=-180&amp;maxlongitude=180&amp;minmagnitude=0&amp;maxmagnitude=10&amp;mindepth=-100&amp;maxdepth=1000&amp;orderby=time-asc&amp;limit=10">
<event catalog:datasource="us" catalog:eventsource="us" catalog:eventid="p0009q04" publicID="quakeml:earthquake.usgs.gov/fdsnws/event/1/query?eventid=usp0009q04&amp;format=quakeml"><description><type>earthquake name</type><text>Guerrero, Mexico</text></description><origin catalog:datasource="us" catalog:dataid="usp0009q04" catalog:eventsource="us" catalog:eventid="p0009q04" publicID="quakeml:earthquake.usgs.gov/archive/product/origin/usp0009q04/us/1415322583878/product.xml"><time><value>2000-03-21T18:28:12.110Z</value></time><longitude><value>-98.851</value></longitude><latitude><value>16.664</value></latitude><depth><value>33000</value><uncertainty>0</uncertainty></depth><originUncertainty><horizontalUncertainty>0</horizontalUncertainty><preferredDescription>horizontal uncertainty</preferredDescription></originUncertainty><quality><standardError>1.04</standardError></quality><evaluationMode>manual</evaluationMode><creationInfo><agencyID>US</agencyID><creationTime>2014-11-07T01:09:43.878Z</creationTime></creationInfo></origin><magnitude catalog:datasource="us" catalog:dataid="usp0009q04" catalog:eventsource="us" catalog:eventid="p0009q04" publicID="quakeml:earthquake.usgs.gov/archive/product/origin/usp0009q04/us/1415322583878/product.xml#magnitude"><mag><value>4.8</value></mag><type>mb</type><stationCount>33</stationCount><originID>quakeml:earthquake.usgs.gov/archive/product/origin/usp0009q04/us/1415322583878/product.xml</originID><evaluationMode>manual</evaluationMode><creationInfo><agencyID>US</agencyID><creationTime>2014-11-07T01:09:43.878Z</creationTime></creationInfo></magnitude><preferredOriginID>quakeml:earthquake.usgs.gov/archive/product/origin/usp0009q04/us/1415322583878/product.xml</preferredOriginID><preferredMagnitudeID>quakeml:earthquake.usgs.gov/archive/product/origin/usp0009q04/us/1415322583878/product.xml#magnitude</preferredMagnitudeID><type>earthquake</type><creationInfo><agencyID>us</agencyID><creationTime>2014-11-07T01:09:43.878Z</creationTime></creationInfo></event>
<event catalog:datasource="us" catalog:eventsource="us" catalog:eventid="p0009q05" publicID="quakeml:earthquake.usgs.gov/fdsnws/event/1/query?eventid=usp0009q05&amp;format=quakeml"><description><type>earthquake name</type><text>offshore Guerrero, Mexico</text></description><origin catalog:datasource="us" catalog:dataid="usp0009q05" catalog:eventsource="us" catalog:eventid="p0009q05" publicID="quakeml:earthquake.usgs.gov/archive/product/origin/usp0009q05/us/1415322583969/product.xml"><time><value>2000-03-21T18:40:19.000Z</value></time><longitude><value>-99.191</value></longitude><latitude><value>16.232</value></latitude><depth><value>16100</value><uncertainty>0</uncertainty></depth><originUncertainty><horizontalUncertainty>0</horizontalUncertainty><preferredDescription>horizontal uncertainty</preferredDescription></originUncertainty><evaluationMode>manual</evaluationMode><creationInfo><agencyID>UNM</agencyID><creationTime>2014-11-07T01:09:43.969Z</creationTime></creationInfo></origin><magnitude catalog:datasource="us" catalog:dataid="usp0009q05" catalog:eventsource="us" catalog:eventid="p0009q05" publicID="quakeml:earthquake.usgs.gov/archive/product/origin/usp0009q05/us/1415322583969/product.xml#magnitude"><mag><value>4</value></mag><type>md</type><originID>quakeml:earthquake.usgs.gov/archive/product/origin/usp0009q05/us/1415322583969/product.xml</originID><evaluationMode>manual</evaluationMode><creationInfo><agencyID>UNM</agencyID><creationTime>2014-11-07T01:09:43.969Z</creationTime></creationInfo></magnitude><preferredOriginID>quakeml:earthquake.usgs.gov/archive/product/origin/usp0009q05/us/1415322583969/product.xml</preferredOriginID><preferredMagnitudeID>quakeml:earthquake.usgs.gov/archive/product/origin/usp0009q05/us/1415322583969/product.xml#magnitude</preferredMagnitudeID><type>earthquake</type><creationInfo><agencyID>us</agencyID><creationTime>2014-11-07T01:09:43.969Z</creationTime></creationInfo></event>
<event catalog:datasource="us" catalog:eventsource="us" catalog:eventid="p0009q06" publicID="quakeml:earthquake.usgs.gov/fdsnws/event/1/query?eventid=usp0009q06&amp;format=quakeml"><description><type>earthquake name</type><text>offshore Guerrero, Mexico</text></description><origin catalog:datasource="us" catalog:dataid="usp0009q06" catalog:eventsource="us" catalog:eventid="p0009q06" publicID="quakeml:earthquake.usgs.gov/archive/product/origin/usp0009q06/us/1415322583972/product.xml"><time><value>2000-03-21T18:50:18.200Z</value></time><longitude><value>-99.12</value></longitude><latitude><value>16.338</value></latitude><depth><value>27100</value><uncertainty>0</uncertainty></depth><originUncertainty><horizontalUncertainty>0</horizontalUncertainty><preferredDescription>horizontal uncertainty</preferredDescription></originUncertainty><evaluationMode>manual</evaluationMode><creationInfo><agencyID>UNM</agencyID><creationTime>2014-11-07T01:09:43.972Z</creationTime></creationInfo></origin><magnitude catalog:datasource="us" catalog:dataid="usp0009q06" catalog:eventsource="us" catalog:eventid="p0009q06" publicID="quakeml:earthquake.usgs.gov/archive/product/origin/usp0009q06/us/1415322583972/product.xml#magnitude"><mag><value>4.2</value></mag><type>md</type><originID>quakeml:earthquake.usgs.gov/archive/product/origin/usp0009q06/us/1415322583972/product.xml</originID><evaluationMode>manual</evaluationMode><creationInfo><agencyID>UNM</agencyID><creationTime>2014-11-07T01:09:43.972Z</creationTime></creationInfo></magnitude><preferredOriginID>quakeml:earthquake.usgs.gov/archive/product/origin/usp0009q06/us/1415322583972/product.xml</preferredOriginID><preferredMagnitudeID>quakeml:earthquake.usgs.gov/archive/product/origin/usp0009q06/us/1415322583972/product.xml#magnitude</preferredMagnitudeID><type>earthquake</type><creationInfo><agencyID>us</agencyID><creationTime>2014-11-07T01:09:43.972Z</creationTime></creationInfo></event>
<creationInfo><creationTime>2015-09-24T13:30:41.000Z</creationTime></creationInfo>
</eventParameters></q:quakeml>
DATA;

        $earthquakes = $this->converter->convert($xml);

        $this->assertEquals(3, count($earthquakes));

        $this->assertEquals('Guerrero, Mexico', $earthquakes[0]->getDescription());
        $this->assertEquals('2000-03-21T18:28:12.110Z', $earthquakes[0]->getTime());
        $this->assertEquals('-98.851', $earthquakes[0]->getLongitude());
        $this->assertEquals('16.664', $earthquakes[0]->getLatitude());
        $this->assertEquals('33000', $earthquakes[0]->getDepth());
        $this->assertEquals('4.8', $earthquakes[0]->getMagnitude());

        $this->assertEquals('offshore Guerrero, Mexico', $earthquakes[1]->getDescription());
        $this->assertEquals('2000-03-21T18:40:19.000Z', $earthquakes[1]->getTime());
        $this->assertEquals('-99.191', $earthquakes[1]->getLongitude());
        $this->assertEquals('16.232', $earthquakes[1]->getLatitude());
        $this->assertEquals('16100', $earthquakes[1]->getDepth());
        $this->assertEquals('4', $earthquakes[1]->getMagnitude());

        $this->assertEquals('offshore Guerrero, Mexico', $earthquakes[2]->getDescription());
        $this->assertEquals('2000-03-21T18:50:18.200Z', $earthquakes[2]->getTime());
        $this->assertEquals('-99.12', $earthquakes[2]->getLongitude());
        $this->assertEquals('16.338', $earthquakes[2]->getLatitude());
        $this->assertEquals('27100', $earthquakes[2]->getDepth());
        $this->assertEquals('4.2', $earthquakes[2]->getMagnitude());
    }
}