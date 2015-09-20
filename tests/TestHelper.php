<?php

namespace Helper;

/**
 * Class TestHelper
 */
class TestHelper
{
    /**
     * @param $object
     * @param string $methodName
     * @param array $parameters
     * @return mixed
     */
    public static function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}