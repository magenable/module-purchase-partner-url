<?php

namespace Magenable\PurchasePartnerUrl\Block\Product;

use Magenable\PurchasePartnerUrl\Helper\Data;

class View extends \Magento\Catalog\Block\Product\View
{
    /**
     * @inheritdoc
     */
    public function getTemplate()
    {
        if ($this->getProduct()->getData(Data::ATTR_CODE)) {
            return 'Magenable_PurchasePartnerUrl::product/view/addtocart.phtml';
        }

        return $this->_template;
    }

    public function getPurchasePartnerUrl()
    {
        return $this->getProduct()->getData(Data::ATTR_CODE);
    }
}
