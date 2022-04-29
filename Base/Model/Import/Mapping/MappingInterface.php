<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Model\Import\Mapping;

/**
 * @since 1.4.6
 */
interface MappingInterface
{
    /**
     * @return array
     */
    public function getValidColumnNames();

    /**
     * @param string $columnName
     *
     * @throws \Awd\Base\Exceptions\MappingColumnDoesntExist
     * @return string|bool
     */
    public function getMappedField($columnName);

    /**
     * @throws \Awd\Base\Exceptions\MasterAttributeCodeDoesntSet
     * @return string
     */
    public function getMasterAttributeCode();
}
