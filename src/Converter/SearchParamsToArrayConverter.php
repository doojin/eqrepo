<?php

namespace Eqrepo\Converter;

use DateTime;
use Eqrepo\Parser\SearchParams;

/**
 * Class SearchParamsToArrayConverter
 * @package Eqrepo\Converter
 */
class SearchParamsToArrayConverter
{
    const DATETIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * @param SearchParams $params
     * @return array
     */
    public function convert(SearchParams $params)
    {
        $result = [];
        $this->populateStartTime($result, $params);
        $this->populateEndTime($result, $params);
        $this->populateMinLatitude($result, $params);
        $this->populateMaxLatitude($result, $params);
        $this->populateMinLongitude($result, $params);
        $this->populateMaxLongitude($result, $params);
        $this->populateMinMagnitude($result, $params);
        $this->populateMaxMagnitude($result, $params);
        $this->populateMinDepth($result, $params);
        $this->populateMaxDepth($result, $params);
        $this->populateOrder($result, $params);
        $this->populateLimit($result, $params);
        return $result;
    }

    /**
     * @param array $result
     * @param SearchParams $params
     */
    private function populateStartTime(array &$result, SearchParams $params)
    {
        $validDate = $this->getValidDate($params->getStartTime());
        if ($validDate === false) {
            return;
        }
        $result['starttime'] = $validDate->format(DateTime::ISO8601);
    }

    /**
     * @param array $result
     * @param SearchParams $params
     */
    private function populateEndTime(array &$result, SearchParams $params)
    {
        $validDate = $this->getValidDate($params->getEndTime());
        if ($validDate === false) {
            return;
        }
        $result['endtime'] = $validDate->format(DateTime::ISO8601);
    }

    /**
     * @param $date
     * @return DateTime|bool
     */
    protected function getValidDate($date)
    {
        if (!isset($date)) return false;
        return DateTime::createFromFormat(
            SearchParamsToArrayConverter::DATETIME_FORMAT,
            $date
        );
    }

    /**
     * @param array $result
     * @param SearchParams $params
     */
    private function populateMinLatitude(array &$result, SearchParams $params)
    {
        $latitude = $params->getMinLatitude();
        if (isset($latitude)) {
            $result['minlatitude'] = $latitude;
        }
    }

    /**
     * @param array $result
     * @param SearchParams $params
     */
    private function populateMaxLatitude(array &$result, SearchParams $params)
    {
        $latitude = $params->getMaxLatitude();
        if (isset($latitude)) {
            $result['maxlatitude'] = $latitude;
        }
    }

    /**
     * @param array $result
     * @param SearchParams $params
     */
    private function populateMinLongitude(array &$result, SearchParams $params)
    {
        $longitude = $params->getMinLongitude();
        if (isset($longitude)) {
            $result['minlongitude'] = $longitude;
        }
    }

    /**
     * @param array $result
     * @param SearchParams $params
     */
    private function populateMaxLongitude(array &$result, SearchParams $params)
    {
        $longitude = $params->getMaxLongitude();
        if (isset($longitude)) {
            $result['maxlongitude'] = $longitude;
        }
    }

    /**
     * @param array $result
     * @param SearchParams $params
     */
    private function populateMinMagnitude(array &$result, SearchParams $params)
    {
        $magnitude = $params->getMinMagnitude();
        if (isset($magnitude)) {
            $result['minmagnitude'] = $magnitude;
        }
    }

    /**
     * @param array $result
     * @param SearchParams $params
     */
    private function populateMaxMagnitude(array &$result, SearchParams $params)
    {
        $magnitude = $params->getMaxMagnitude();
        if (isset($magnitude)) {
            $result['maxmagnitude'] = $magnitude;
        }
    }

    /**
     * @param array $result
     * @param SearchParams $params
     */
    private function populateMinDepth(array &$result, SearchParams $params)
    {
        $depth = $params->getMinDepth();
        if (isset($depth)) {
            $result['mindepth'] = $depth;
        }
    }

    /**
     * @param array $result
     * @param SearchParams $params
     */
    private function populateMaxDepth(array &$result, SearchParams $params)
    {
        $depth = $params->getMaxDepth();
        if (isset($depth)) {
            $result['maxdepth'] = $depth;
        }
    }

    /**
     * @param array $result
     * @param SearchParams $params
     */
    private function populateOrder(array &$result, SearchParams $params)
    {
        $order = $params->getOrderBy();
        if (isset($order)) {
            $result['orderby'] = $order;
        }
    }

    /**
     * @param array $result
     * @param SearchParams $params
     */
    private function populateLimit(array &$result, SearchParams $params)
    {
        $limit = $params->getLimit();
        if (isset($limit)) {
            $result['limit'] = $limit;
        }
    }
}