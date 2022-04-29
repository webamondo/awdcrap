<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Plugin\AdminNotification\Block\Grid\Renderer;

use Magento\AdminNotification\Block\Grid\Renderer\Notice as NativeNotice;

class Notice
{
    public function aroundRender(
        NativeNotice $subject,
        \Closure $proceed,
        \Magento\Framework\DataObject $row
    ) {
        $result = $proceed($row);

        $awdLogo = '';
        $awdImage = '';
        if ($row->getData('is_awd')) {
            if ($row->getData('image_url')) {
                $awdImage = ' style="background: url(' . $row->getData("image_url") . ') no-repeat;"';
            } else {
                $awdLogo = ' awd-grid-logo';
            }
        }
        $result = '<div class="ambase-grid-message' . $awdLogo . '"' . $awdImage . '>' . $result . '</div>';

        return  $result;
    }
}
