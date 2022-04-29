<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Model\Import\Validation;

use Awd\Base\Model\Import\AbstractImport;

class Validator implements ValidatorInterface
{
    /**
     * @var \Magento\Framework\DataObject
     */
    protected $validationData;

    public function __construct(\Magento\Framework\DataObject $validationData)
    {
        $this->validationData = $validationData;
    }

    protected $errors = [];

    /**
     * @var array
     */
    protected $messageTemplates = [

    ];

    /**
     * @inheritdoc
     */
    public function validateRow(array $rowData, $behavior)
    {
        return true;
    }

    /**
     * Usual behavior at the end of validation. Help function
     *
     * @return array|bool
     */
    public function validateResult()
    {
        if ($this->errors) {
            return $this->errors;
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function getErrorMessages()
    {
        return $this->messageTemplates;
    }

    /**
     * @inheritDoc
     */
    public function addRuntimeError($message, $level)
    {
        if (!isset($this->errors[AbstractImport::RUNTIME_ERRORS])) {
            $this->errors[AbstractImport::RUNTIME_ERRORS] = [];
        }

        $this->errors[AbstractImport::RUNTIME_ERRORS][(string)(__('<b>Error!</b> ')) . $message] = $level;

        return $this;
    }
}
