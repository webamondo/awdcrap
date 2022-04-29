<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Exceptions;

class MappingColumnDoesntExist extends \Magento\Framework\Exception\LocalizedException
{
    /**
     * @param \Magento\Framework\Phrase $phrase
     * @param \Exception $cause
     * @param int $code
     */
    public function __construct(\Magento\Framework\Phrase $phrase = null, \Exception $cause = null, $code = 0)
    {
        if (!$phrase) {
            $phrase = __('Mapping column doesn\'t exist.');
        }
        parent::__construct($phrase, $cause, (int) $code);
    }
}
