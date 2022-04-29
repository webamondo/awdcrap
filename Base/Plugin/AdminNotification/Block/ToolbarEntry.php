<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Plugin\AdminNotification\Block;

use Magento\AdminNotification\Block\ToolbarEntry as NativeToolbarEntry;

/**
 * Add html attributes to awd notifications
 */
class ToolbarEntry
{
    const AWD_ATTRIBUTE = ' data-ambase-logo="1"';

    public function afterToHtml(
        NativeToolbarEntry $subject,
        $html
    ) {
        $collection = $subject->getLatestUnreadNotifications()
            ->clear()
            ->addFieldToFilter('is_awd', 1);

        foreach ($collection as $item) {
            $search = 'data-notification-id="' . $item->getId() . '"';
            if ($item->getData('image_url')) {
                $html = str_replace(
                    $search,
                    $search . ' style='
                    . '"background: url(' . $item->getData('image_url') . ') no-repeat 5px 7px; background-size: 30px;"'
                    . self::AWD_ATTRIBUTE,
                    $html
                );
            } else {
                $html = str_replace($search, $search . self::AWD_ATTRIBUTE, $html);
            }
        }

        return $html;
    }
}
