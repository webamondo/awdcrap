<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/

declare(strict_types=1);

namespace Awd\Base\Plugin\Framework\Setup\Declaration\Schema\Diff\Diff;

use Magento\Framework\Setup\Declaration\Schema\Diff\Diff;
use Magento\Framework\Setup\Declaration\Schema\Dto\ElementInterface;
use Magento\Framework\Setup\Declaration\Schema\Operations\DropTable;

/**
 * Fix an issue - when a module is disabled, db_schema.xml of the module is not collecting.
 * But db_schema_whitelist.json is readable even if the module disabled.
 * It cause the issue - DB Tables drops while module is disabled.
 */
class RestrictDropTables
{
    /**
     * Restrict to delete Awd tables throw Declarative Schema.
     *
     * @param Diff $subject
     * @param bool $result
     * @param ElementInterface $object
     * @param string $operation
     *
     * @return bool
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterCanBeRegistered(Diff $subject, bool $result, ElementInterface $object, $operation): bool
    {
        if ($result === true
            && $operation === DropTable::OPERATION_NAME
            && stripos($object->getName(), 'awd') !== false
        ) {
            $result = false;
        }

        return $result;
    }
}
