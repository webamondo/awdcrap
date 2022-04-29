<?php
/**
 * @author Awd Team
 * @copyright Copyright (c) 2019 Awd (https://www.advancedwebsitedesign.co.uk)
 * @package Awd_Base
 */


namespace Awd\Base\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Utils
 * @package Awd\Base\Helper
 */
class Utils extends AbstractHelper
{
    public function _exit($code = 0)
    {
        /** @codingStandardsIgnoreStart */
        exit($code);
        /** @codingStandardsIgnoreEnd */
    }

    public function _echo($a)
    {
        /** @codingStandardsIgnoreStart */
        echo $a;
        /** @codingStandardsIgnoreEnd */
    }
}
