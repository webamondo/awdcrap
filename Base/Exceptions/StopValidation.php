<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Exceptions;

class StopValidation extends \Exception
{
    /**
     * @var array|bool
     */
    protected $validateResult;

    /**
     * @param array|bool $validateResult
     */
    public function __construct($validateResult)
    {
        $this->validateResult = $validateResult;
    }

    /**
     * @return array|bool
     */
    public function getValidateResult()
    {
        return $this->validateResult;
    }
}
