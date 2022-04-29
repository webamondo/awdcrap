<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Block\Adminhtml;

use Awd\Base\Model\ModuleListProcessor;
use Magento\Backend\Block\Template;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Store\Model\ScopeInterface;
use Awd\Base\Model\Source\NotificationType;
use Awd\Base\Model\Config;

class Notification extends Field
{
    protected $_template = 'Awd_Base::notification.phtml';

    /**
     * @var ModuleListProcessor
     */
    private $moduleListProcessor;

    /**
     * @var Config
     */
    private $config;

    public function __construct(
        Template\Context $context,
        ModuleListProcessor $moduleListProcessor,
        Config $config,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->moduleListProcessor = $moduleListProcessor;
        $this->config = $config;
    }

    protected function _toHtml()
    {
        if ($this->isSetNotification()) {
            return parent::_toHtml();
        }

        return '';
    }

    /**
     * @return int|null
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function getUpdatesCount()
    {
        $modules = $this->moduleListProcessor->getModuleList();

        return count($modules['hasUpdate']);
    }

    /**
     * @return bool
     */
    protected function isSetNotification()
    {
        $value = $this->config->getEnabledNotificationTypes();

        return in_array(NotificationType::AVAILABLE_UPDATE, $value);
    }
}
