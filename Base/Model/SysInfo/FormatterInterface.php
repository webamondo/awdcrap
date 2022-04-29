<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


declare(strict_types=1);

namespace Awd\Base\Model\SysInfo;

interface FormatterInterface
{
    public function format(array $info): array;
}
