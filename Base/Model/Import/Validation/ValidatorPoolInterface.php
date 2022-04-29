<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Model\Import\Validation;

interface ValidatorPoolInterface
{
    /**
     * @return \Awd\Base\Model\Import\Validation\ValidatorInterface[]
     */
    public function getValidators();

    /**
     * @param \Awd\Base\Model\Import\Validation\ValidatorInterface
     *
     * @return void
     */
    public function addValidator($validator);
}
