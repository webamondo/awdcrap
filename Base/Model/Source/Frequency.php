<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Model\Source;

class Frequency implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => 2,
                'label' => __('2 days')
            ],
            [
                'value' => 5,
                'label' => __('5 days')
            ],
            [
                'value' => 10,
                'label' => __('10 days')
            ],
            [
                'value' => 15,
                'label' => __('15 days')
            ],
            [
                'value' => 30,
                'label' => __('30 days')
            ]
        ];

        return $options;
    }
}
