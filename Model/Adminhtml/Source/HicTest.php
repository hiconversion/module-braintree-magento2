<?php

namespace Magento\Braintree\Model\Adminhtml\Source;

/**
 * Class HicTest
 */
class HicTest implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'off', 'label' => __('Off')],
            ['value' => 'test', 'label' => __('Test')],
            ['value' => 'enabled', 'label' => __('Enabled')]
        ];
    }
}
