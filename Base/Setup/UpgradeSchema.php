<?php
/**
 * @author Awd Team
 * @copyright Copyright (c) 2019 Awd (https://www.advancedwebsitedesign.co.uk)
 * @package Awd_Base
 */


namespace Awd\Base\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class UpgradeSchema
 * @package Awd\Base\Setup
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.4.0', '<')) {
            $this->addIsAwdField($setup);
        }

        if (version_compare($context->getVersion(), '1.4.2', '<')) {
            $this->addExpireField($setup);
        }

        if (version_compare($context->getVersion(), '1.6.2', '<')) {
            $this->addImageUrlField($setup);
        }
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function addIsAwdField(SchemaSetupInterface $setup)
    {
        $setup->getConnection()->addColumn(
            $setup->getTable('adminnotification_inbox'),
            'is_awd',
            [
                'type' => Table::TYPE_SMALLINT,
                'nullable' => false,
                'default' => 0,
                'comment' => 'Is Awd Notification'
            ]
        );
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function addExpireField(SchemaSetupInterface $setup)
    {
        $setup->getConnection()->addColumn(
            $setup->getTable('adminnotification_inbox'),
            'expiration_date',
            [
                'type' => Table::TYPE_DATETIME,
                'nullable' => true,
                'default' => null,
                'comment' => 'Expiration Date'
            ]
        );
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function addImageUrlField(SchemaSetupInterface $setup)
    {
        $setup->getConnection()->addColumn(
            $setup->getTable('adminnotification_inbox'),
            'image_url',
            [
                'type' => Table::TYPE_TEXT,
                'nullable' => true,
                'default' => null,
                'comment' => 'Image Url'
            ]
        );
    }
}
