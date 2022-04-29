<?php
/**
 * @author Awd Team
 * @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
 * @package Awd_Base
 */

declare(strict_types=1);

namespace Awd\Base\Exceptions;

class PhpFunctionIsDisabled extends \Magento\Framework\Exception\LocalizedException
{
    public function __construct(\Magento\Framework\Phrase $phrase = null, \Exception $cause = null, $code = 0)
    {
        if (!$phrase) {
            $phrase = __('PHP function is disabled.');
        }
        parent::__construct($phrase, $cause, (int) $code);
    }
}
