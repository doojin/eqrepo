<?php

namespace Eqrepo\Model;

/**
 * Class Earthquake
 * @package Eqrepo\Model
 */
class Earthquake
{
    /** @var  string */
    private $description;

    /** @var  string */
    private $time;

    /** @var  string */
    private $longitude;

    /** @var  string */
    private $latitude;

    /** @var  string */
    private $depth;

    /** @var  string */
    private $magnitude;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @param string $depth
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    /**
     * @return string
     */
    public function getMagnitude()
    {
        return $this->magnitude;
    }

    /**
     * @param string $magnitude
     */
    public function setMagnitude($magnitude)
    {
        $this->magnitude = $magnitude;
    }
}