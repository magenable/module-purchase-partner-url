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
        $purchasePartnerUrls = $this->getProduct()->getData(Data::ATTR_CODE);
        if ($moduleIsEnabled && $purchasePartnerUrls) {
            if (count($purchasePartnerUrls) > 1) {
                return 'Magenable_PurchasePartnerUrl::product/view/addtocart-multiple.phtml';
            } else {
                return 'Magenable_PurchasePartnerUrl::product/view/addtocart.phtml';
            }
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
     * @return int
     */
    public function analyticsIsEnabled(): int
    {
        return (int)$this->_scopeConfig->getValue(
            Data::CONFIG_ANALYTICS_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function getDefaultEventCategory(): string
    {
        return $this->_scopeConfig->getValue(
            Data::CONFIG_DEFAULT_EVENT_CATEGORY,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function getDefaultEventAction(): string
    {
        return $this->_scopeConfig->getValue(
            Data::CONFIG_DEFAULT_EVENT_ACTION,
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

    /**
     * @return int
     */
    public function getEventValue(): int
    {
        $price = $this->getProduct()->getPrice();
        if ($price < 1) {
            $price = 1;
        } else {
            $price = round($price);
        }

        return (int)$price;
    }
}
