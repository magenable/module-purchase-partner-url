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
            $showAllLinks = (int)$this->_scopeConfig->getValue(
                Data::CONFIG_SHOW_ALL_LINKS,
                ScopeInterface::SCOPE_STORE
            );

            if (count($purchasePartnerUrls) > 1 && !$showAllLinks) {
                return 'Magenable_PurchasePartnerUrl::product/view/addtocart-multiple.phtml';
            } else {
                return 'Magenable_PurchasePartnerUrl::product/view/addtocart.phtml';
            }
        }

        return $this->_template;
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
        $price = (float)$this->getProduct()->getPrice();
        if ($price < 1) {
            $price = 1;
        } else {
            $price = round($price);
        }

        return (int)$price;
    }
}
