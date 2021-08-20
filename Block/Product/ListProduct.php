<?php

namespace Magenable\PurchasePartnerUrl\Block\Product;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\Product;
use Magenable\PurchasePartnerUrl\Helper\Data;
use Magento\Store\Model\ScopeInterface;

class ListProduct extends Template
{
    /**
     * @var \Magento\Catalog\Model\Product $product
     */
    private $product;

    /**
     * @inheritdoc
     */
    public function getTemplate()
    {
        return 'Magenable_PurchasePartnerUrl::product/list.phtml';
    }

    /**
     * @param \Magento\Catalog\Model\Product $product
     * @return \Magenable\PurchasePartnerUrl\Block\Product\ListProduct
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
        return $this->product;
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
