<?php
declare(strict_types=1);

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
    public function getDefaultButtonTitle(): string
    {
        return $this->_scopeConfig->getValue(
            Data::CONFIG_DEFAULT_TITLE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return array|null
     */
    public function getPurchasePartnerUrls(): ?array
    {
        return $this->getProduct()->getData(Data::ATTR_CODE);
    }
}
