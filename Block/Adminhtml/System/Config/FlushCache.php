<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class FlushCache extends Field
{
    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element): string
    {
        return '
            <div class="notices-wrapper">
                    <div class="messages">
                        <div class="message" style="margin-top:10px">
                            <strong>' . __('After changing settings need to flush cache.') . '</strong>
                            <hr>
                            <code>System -> Cache Management -> <b>Flush Magento Cache</b></code>
                        </div>
                    </div>
            </div>';
    }
}
