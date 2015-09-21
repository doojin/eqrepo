<?php

namespace Eqrepo\Parser;
use Eqrepo\Converter\SearchParamsToArrayConverter;

/**
 * Class UriBuilder
 * @package Eqrepo\Parser
 */
class UriBuilder
{
    const BASE_URL = 'http://earthquake.usgs.gov/fdsnws/event/1/query';

    private $converter;

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->converter = new SearchParamsToArrayConverter();
    }

    /**
     * @param SearchParams $searchParams
     * @return string
     */
    public function buildUri(SearchParams $searchParams)
    {
        $queryData = $this->converter->convert($searchParams);
        return UriBuilder::BASE_URL . '?' . http_build_query($queryData);
    }
}