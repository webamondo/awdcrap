<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Debug;

/**
 * For Remote Debug
 * Output is to front
 * @codeCoverageIgnore
 * @codingStandardsIgnoreFile
 */
class VarDump
{
    /**
     * @var array
     */
    private static $addressPath = [
        'REMOTE_ADDR',
        'HTTP_X_REAL_IP',
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR'
    ];

    /**
     * @var array
     */
    private static $awdIps = [
        '213.184.226.82',
        '87.252.238.217',
        '82.209.247.206',
    ];

    /**
     * @var int
     */
    private static $objectDepthLevel = 1;

    /**
     * @var int
     */
    private static $arrayDepthLevel = 2;

    /**
     * @param int $level
     */
    public static function setObjectDepthLevel($level)
    {
        self::$objectDepthLevel = (int)$level;
    }

    /**
     * @param int $level
     */
    public static function setArrayDepthLevel($level)
    {
        self::$arrayDepthLevel = (int)$level;
    }

    public static function execute()
    {
        if (self::isAllowed()) {
            foreach (func_get_args() as $var) {
                System\Beautifier::getInstance()->beautify(self::dump($var));
            }
        }
    }

    /**
     * @param array $array
     * @param int   $level
     *
     * @return array|string
     */
    private static function castArray($array, $level)
    {
        if ($level > self::$arrayDepthLevel) {
            return '...';
        }
        $result = [];
        foreach ($array as $key => $value) {
            switch (strtolower(gettype($value))) {
                case 'object':
                    $result[$key] = self::castObject($value, $level + 1);
                    break;
                case 'array':
                    $result[$key] = self::castArray($value, $level + 1);
                    break;
                default:
                    $result[$key] = $value;
                    break;
            }
        }
        return $result;
    }

    /**
     * @param     $object
     * @param int $level
     *
     * @return System\AwdDump|string
     */
    private static function castObject($object, $level)
    {
        if ($level > self::$objectDepthLevel) {
            return '...';
        }
        $reflection = new \ReflectionClass($object);

        $awdDump = new System\AwdDump();

        $awdDump->className = $reflection->getName();
        $awdDump->shortClassName = $reflection->getShortName();

        foreach ($reflection->getMethods() as $method) {
            $awdDump->methods[] = $method->getName();
        }
        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $propertyValue = $property->getValue($object);
            switch (strtolower(gettype($propertyValue))) {
                case 'object':
                    $awdDump->properties[$property->name] = self::castObject($propertyValue, $level + 1);
                    break;
                case 'array':
                    $awdDump->properties[$property->name] = self::castArray($propertyValue, $level + 1);
                    break;
                default:
                    $awdDump->properties[$property->name] = $propertyValue;
                    break;
            }
        }
        return $awdDump;
    }

    /**
     * @param mixed $var
     *
     * @return AwdDump|array|mixed
     */
    public static function dump($var)
    {
        if (self::isAllowed()) {
            switch (strtolower(gettype($var))) {
                case 'object':
                    return self::castObject($var, 0);
                case 'array':
                    return self::castArray($var, 0);
                case 'resource':
                    return stream_get_meta_data($var);
                default:
                    return $var;
            }
        }
    }

    /**
     * Check for Awd Ips
     *
     * @return bool
     */
    public static function isAllowed()
    {
        foreach (self::$addressPath as $path) {
            if (!empty($_SERVER[$path]) && in_array($_SERVER[$path], self::$awdIps, true)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param int $code
     */
    public static function awdExit($code = 0)
    {
        if (self::isAllowed()) {
            if (class_exists(\Zend\Console\Response::class)) {
                (new \Zend\Console\Response())->send();
            }
        }
    }

    /**
     * @param string $string
     */
    public static function awdEcho($string)
    {
        if (self::isAllowed()) {
            printf('%s', $string);
        }
    }
}
