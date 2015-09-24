<?php

namespace Eqrepo\Converter;

use Eqrepo\Helper\StringHelper;
use Eqrepo\Model\Earthquake;
use SimpleXMLElement;

/**
 * Class XmlToEarthquakeArrayConverter
 * @package Eqrepo\Converter
 */
class XmlToEarthquakeArrayConverter
{

    /**
     * @param string $xml
     * @return Earthquake[]
     */
    public function convert($xml)
    {
        $earthquakes = new SimpleXMLElement($xml);
        $results = [];
        foreach ($earthquakes->eventParameters->event as $earthquakeXMLElement) {
            $results[] = $this->extractEarthquake($earthquakeXMLElement);
        }
        return $results;
    }

    /**
     * @param SimpleXMLElement $earthquakeXMLElement
     * @return Earthquake
     */
    private function extractEarthquake(SimpleXMLElement $earthquakeXMLElement)
    {
        $earthquake = new Earthquake();
        $earthquake->setDescription($this->extractDescription($earthquakeXMLElement));
        $earthquake->setTime($this->extractTime($earthquakeXMLElement));
        $earthquake->setLongitude($this->extractLongitude($earthquakeXMLElement));
        $earthquake->setLatitude($this->extractLatitude($earthquakeXMLElement));
        $earthquake->setDepth($this->extractDepth($earthquakeXMLElement));
        $earthquake->setMagnitude($this->extractMagnitude($earthquakeXMLElement));
        return $earthquake;
    }

    /**
     * @param SimpleXMLElement $earthquakeXmlElement
     * @return string|null
     */
    private function extractDescription(SimpleXMLElement $earthquakeXmlElement)
    {
        @$description = (string)$earthquakeXmlElement->description->text;
        return StringHelper::notEmptyStringOrNull($description);
    }

    /**
     * @param SimpleXMLElement $earthquakeXmlElement
     * @return string|null
     */
    private function extractTime(SimpleXMLElement $earthquakeXmlElement)
    {
        @$time = (string)$earthquakeXmlElement->origin->time->value;
        return StringHelper::notEmptyStringOrNull($time);
    }

    /**
     * @param SimpleXMLElement $earthquakeXmlElement
     * @return string|null
     */
    private function extractLongitude(SimpleXMLElement $earthquakeXmlElement)
    {
        @$longitude = (string)$earthquakeXmlElement->origin->longitude->value;
        return StringHelper::notEmptyStringOrNull($longitude);
    }

    /**
     * @param SimpleXMLElement $earthquakeXmlElement
     * @return string|null
     */
    private function extractLatitude(SimpleXMLElement $earthquakeXmlElement)
    {
        @$latitude = (string)$earthquakeXmlElement->origin->latitude->value;
        return StringHelper::notEmptyStringOrNull($latitude);
    }

    /**
     * @param SimpleXMLElement $earthquakeXmlElement
     * @return string|null
     */
    private function extractDepth(SimpleXMLElement $earthquakeXmlElement)
    {
        @$depth = (string)$earthquakeXmlElement->origin->depth->value;
        return StringHelper::notEmptyStringOrNull($depth);
    }

    /**
     * @param SimpleXMLElement $earthquakeXmlElement
     * @return string|null
     */
    private function extractMagnitude(SimpleXMLElement $earthquakeXmlElement)
    {
        @$magnitude = (string)$earthquakeXmlElement->magnitude->mag->value;
        return StringHelper::notEmptyStringOrNull($magnitude);
    }
}