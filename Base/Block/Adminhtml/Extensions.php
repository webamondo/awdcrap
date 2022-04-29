<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Block\Adminhtml;

use Awd\Base\Model\ModuleInfoProvider;
use Awd\Base\Model\ModuleListProcessor;
use Magento\Backend\Block\Template;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Extensions extends Field
{
    const SEO_PARAMS = '?utm_source=extension&utm_medium=backend&utm_campaign=ext_list';

    protected $_template = 'Awd_Base::modules.phtml';

    /**
     * @var ModuleListProcessor
     */
    private $moduleListProcessor;

    /**
     * @var ModuleInfoProvider
     */
    private $moduleInfoProvider;

    public function __construct(
        Template\Context $context,
        ModuleListProcessor $moduleListProcessor,
        ModuleInfoProvider $moduleInfoProvider,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->moduleListProcessor = $moduleListProcessor;
        $this->moduleInfoProvider = $moduleInfoProvider;
    }

    protected function _getElementHtml(AbstractElement $element)
    {
        return $this->toHtml();
    }

    /**
     * @return array
     */
    public function getModuleList()
    {
        return $this->moduleListProcessor->getModuleList();
    }

    /**
     * @return bool
     */
    public function isOriginMarketplace()
    {
        return $this->moduleInfoProvider->isOriginMarketplace();
    }

    /**
     * return empty value where origin marketplace
     *
     * @return string
     */
    public function getSeoparams()
    {
        return !$this->isOriginMarketplace() ? self::SEO_PARAMS : '';
    }
}
