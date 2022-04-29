<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

/**
 * Class Advertise for adding advertise
 */
class Advertise extends Field
{
    /**
     * @param AbstractElement $element
     *
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $commentText = $element->getContainer()->getGroup()['data']['text'];
        $element->setValue(__('Not Installed'));
        $element->setHtmlId('awd_not_instaled');
        $element->setComment(__($commentText));
        $element->setLabel(__('Status'));

        return parent::render($element);
    }

    /**
     * @inheritDoc
     */
    protected function _renderScopeLabel(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    protected function _isInheritCheckboxRequired(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    protected function _renderInheritCheckbox(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return '';
    }
}
