<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Model\Import\Mapping;

class Mapping implements MappingInterface
{
    /**
     * @var string
     */
    protected $masterAttributeCode = '';

    /**
     * FYI: column names pattern [a-z][a-z0-9_]*
     * @var array
     */
    protected $mappings = [
        /**
         * csv_column_name => model_column_name
         * model_column_name (numeric key means model_column_name => model_column_name)
        **/
    ];

    /**
     * @var array
     */
    private $processedMapping;

    /**
     * @inheritdoc
     */
    public function getValidColumnNames()
    {
        return array_keys($this->processedMapping());
    }

    /**
     * @inheritdoc
     */
    public function getMappedField($columnName)
    {
        if (!isset($this->processedMapping()[$columnName])) {
            throw new \Awd\Base\Exceptions\MappingColumnDoesntExist();
        }

        return $this->processedMapping()[$columnName];
    }

    /**
     * @inheritdoc
     */
    public function getMasterAttributeCode()
    {
        if (empty($this->masterAttributeCode)) {
            throw new \Awd\Base\Exceptions\MasterAttributeCodeDoesntSet();
        }

        return $this->masterAttributeCode;
    }

    public function processedMapping()
    {
        if (null === $this->processedMapping) {
            $this->processedMapping = [];
            foreach ($this->mappings as $csvField => $field) {
                if (is_numeric($csvField)) {
                    $this->processedMapping[$field] = $field;
                } else {
                    $this->processedMapping[$csvField] = $field;
                }
            }
        }

        return $this->processedMapping;
    }
}
