<?php

namespace Eqrepo\Parser;

/**
 * Class SearchParams
 * @package Eqrepo\Parser
 */
class SearchParams
{
    const ORDER_TIME_ASC = 'time-asc';
    const ORDER_TIME_DESC = 'time';
    const ORDER_MAG_ASC = 'magnitude-asc';
    const ORDER_MAG_DESC = 'magnitude';

    /**
     * Start time of earthquakes
     *
     * @var string
     */
    private $startTime;

    /**
     * End time of earthquakes
     *
     * @var string
     */
    private $endTime;

    /**
     * Minimal latitude of earthquakes (-90..90)
     *
     * @var float
     */
    private $minLatitude;

    /**
     * Maximal latitude of earthquakes (-90..90)
     *
     * @var float
     */
    private $maxLatitude;

    /**
     * Minimal longitude of earthquakes (-180..180)
     *
     * @var float
     */
    private $minLongitude;

    /**
     * Maximal longitude of earthquakes (-180..180)
     *
     * @var float
     */
    private $maxLongitude;

    /**
     * Minimal magnitude
     *
     * @var float
     */
    private $minMagnitude;

    /**
     * Maximal magnitude
     *
     * @var float
     */
    private $maxMagnitude;

    /**
     * Minimal depth (km) of earthquakes (-100..1000)
     *
     * @var float
     */
    private $minDepth;

    /**
     * Maximal depth (km) of earthquakes (-100..1000)
     *
     * @var float
     */
    private $maxDepth;

    /**
     * Order parameter
     *
     * @var int
     */
    private $orderBy;

    /**
     * Limit of returned results (1..20000)
     *
     * @var int
     */
    private $limit;

    /**
     * @param string $startTime
     * @return $this
     */
    public function withStartTime($startTime)
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * @param string $endTime
     * @return $this
     */
    public function withEndTime($endTime)
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * @param float $latitude
     * @return $this
     */
    public function withMinLatitude($latitude)
    {
        $this->minLatitude = $latitude;
        return $this;
    }

    /**
     * @param float $latitude
     * @return $this
     */
    public function withMaxLatitude($latitude)
    {
        $this->maxLatitude = $latitude;
        return $this;
    }

    /**
     * @param float $longitude
     * @return $this
     */
    public function withMinLongitude($longitude)
    {
        $this->minLongitude = $longitude;
        return $this;
    }

    /**
     * @param float $longitude
     * @return $this
     */
    public function withMaxLongitude($longitude)
    {
        $this->maxLongitude = $longitude;
        return $this;
    }

    /**
     * @param float $magnitude
     * @return $this
     */
    public function withMinMagnitude($magnitude)
    {
        $this->minMagnitude = $magnitude;
        return $this;
    }

    /**
     * @param float $magnitude
     * @return $this
     */
    public function withMaxMagnitude($magnitude)
    {
        $this->maxMagnitude = $magnitude;
        return $this;
    }

    /**
     * @param float $depth
     * @return $this
     */
    public function withMinDepth($depth)
    {
        $this->minDepth = $depth;
        return $this;
    }

    /**
     * @param float $depth
     * @return $this
     */
    public function withMaxDepth($depth)
    {
        $this->maxDepth = $depth;
        return $this;
    }

    /**
     * $order parameter's values:
     * SearchParams::ORDER_TIME_ASC
     * SearchParams::ORDER_TIME_DESC
     * SearchParams::ORDER_MAG_ASC
     * SearchParams::ORDER_MAG_DESC
     *
     * @param int $order
     * @return $this
     */
    public function withOrder($order)
    {
        $this->orderBy = $order;
        return $this;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function withLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return string
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @return string
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @return float
     */
    public function getMinLatitude()
    {
        return $this->minLatitude;
    }

    /**
     * @return float
     */
    public function getMaxLatitude()
    {
        return $this->maxLatitude;
    }

    /**
     * @return float
     */
    public function getMinLongitude()
    {
        return $this->minLongitude;
    }

    /**
     * @return float
     */
    public function getMaxLongitude()
    {
        return $this->maxLongitude;
    }

    /**
     * @return float
     */
    public function getMinMagnitude()
    {
        return $this->minMagnitude;
    }

    /**
     * @return float
     */
    public function getMaxMagnitude()
    {
        return $this->maxMagnitude;
    }

    /**
     * @return float
     */
    public function getMinDepth()
    {
        return $this->minDepth;
    }

    /**
     * @return float
     */
    public function getMaxDepth()
    {
        return $this->maxDepth;
    }

    /**
     * @return int
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }
}