<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magenable\PurchasePartnerUrl\Helper\Data;
use Magento\Catalog\Block\Product\View;
use Magento\Catalog\Model\Product;
use Magento\Store\Model\ScopeInterface;

class ProductViewPlugin
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var Data
     */
    private $dataHelper;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Data $dataHelper
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->dataHelper = $dataHelper;
    }

    /**
     * @param View $subject
     * @param Product $result
     * @return Product
     */
    public function afterGetProduct(View $subject, Product $result): Product
    {
        $moduleIsEnabled = $this->scopeConfig->getValue(
            Data::CONFIG_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
        if ($moduleIsEnabled) {
            $this->dataHelper->skipSaleableCheckPlugin(true);
        }

        return $result;
    }
}
