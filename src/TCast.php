<?php

namespace PhpCast;

use ReflectionException;
use ReflectionObject;

trait TCast
{
    /**
     * Class casting
     *
     * @param object $sourceObject
     * @param array $mapping
     * @return object
     */
    public static function cast($sourceObject, array $mapping = [])
    {
        $destinationObject = new self();
        try {
            $reflectedSource = new ReflectionObject($sourceObject);
            $reflectedDestination = new ReflectionObject($destinationObject);
            $sourceProperties = $reflectedSource->getProperties();
            foreach ($sourceProperties as $sourceProperty) {
                $sourceProperty->setAccessible(true);
                $name = $sourceProperty->getName();
                $name = array_key_exists($name, $mapping) ? $mapping[$name] : $name;
                $value = $sourceProperty->getValue($sourceObject);
                if ($reflectedDestination->hasProperty($name)) {
                    $propDest = $reflectedDestination->getProperty($name);
                    $propDest->setAccessible(true);
                    $propDest->setValue($destinationObject, $value);
                } else {
                    $destinationObject->$name = $value;
                }
            }
        } catch (ReflectionException $exception) {
            return $sourceObject;
        }
        return $destinationObject;
    }
}