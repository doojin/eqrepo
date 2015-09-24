<?php

namespace Eqrepo\Helper;

use PHPUnit_Framework_TestCase;

/**
 * Class StringHelperTest
 * @package Eqrepo\Helper
 */
class StringHelperTest extends PHPUnit_Framework_TestCase
{
    public function testNotEmptyStringOrNull_shouldReturnSameStringIfNotEmpty()
    {
        $result = StringHelper::notEmptyStringOrNull('not empty string');
        $this->assertEquals('not empty string', $result);
    }

    public function testNotEmptyStringOrNull_shouldReturnNullIfStringIsEmpty()
    {
        $result = StringHelper::notEmptyStringOrNull('');
        $this->assertNull($result);
    }
}