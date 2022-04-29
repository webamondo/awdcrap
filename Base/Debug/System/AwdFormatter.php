<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Debug\System;

class AwdFormatter extends \Monolog\Formatter\LineFormatter
{
    /**
     * @param array $record
     *
     * @return string
     */
    public function format(array $record)
    {
        $output = $this->format;
        $output = str_replace('%datetime%', date('H:i d/m/Y'), $output);
        $output = str_replace('%message%', $record['message'], $output);
        return $output;
    }
}
