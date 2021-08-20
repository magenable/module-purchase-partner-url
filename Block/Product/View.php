<?php

namespace Magenable\PurchasePartnerUrl\Block\Product;

use Magenable\PurchasePartnerUrl\Helper\Data;
use Magento\Store\Model\ScopeInterface;

class View extends \Magento\Catalog\Block\Product\View
{
    /**
     * @inheritdoc
     */
    public function getTemplate()
    {
        $moduleIsEnabled = $this->_scopeConfig->getValue(
            Data::CONFIG_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
        if ($moduleIsEnabled && $this->getProduct()->getData(Data::ATTR_CODE)) {
            return 'Magenable_PurchasePartnerUrl::product/view/addtocart.phtml';
        }

        return $this->_template;
    }

    /**
     * @return string
     */
    public function getButtonTitle()
    {
        return $this->_scopeConfig->getValue(
            Data::CONFIG_DEFAULT_TITLE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string|null
     */
    public function getPurchasePartnerUrl()
    {
        return $this->getProduct()->getData(Data::ATTR_CODE);
    }
}
