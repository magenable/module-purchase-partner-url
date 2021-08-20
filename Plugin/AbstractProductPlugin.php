<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Plugin;

use Magento\Framework\View\LayoutFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Model\Product;
use Magento\Store\Model\ScopeInterface;
use Magenable\PurchasePartnerUrl\Helper\Data;
use Magenable\PurchasePartnerUrl\Block\Product\ListProduct;

class AbstractProductPlugin
{
    /**
     * @var \Magento\Framework\View\LayoutFactory
     */
    private $layoutFactory;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param \Magento\Framework\View\LayoutFactory $layoutFactory
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        LayoutFactory $layoutFactory,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->layoutFactory = $layoutFactory;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param \Magento\Catalog\Block\Product\AbstractProduct $subject
     * @param mixed $result
     * @param \Magento\Catalog\Model\Product $product
     * @return mixed
     */
    public function afterGetProductDetailsHtml(AbstractProduct $subject, $result, Product $product)
    {
        $moduleIsEnabled = $this->scopeConfig->getValue(
            Data::CONFIG_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
        if ($moduleIsEnabled && $product->getData(Data::ATTR_CODE)) {
            $output = $this->layoutFactory->create()
                ->createBlock(ListProduct::class)
                ->setProduct($product)
                ->toHtml();

            $result .= $output;
        }

        return $result;
    }
}
