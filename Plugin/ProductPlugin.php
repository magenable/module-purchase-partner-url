<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magenable\PurchasePartnerUrl\Helper\Data;
use Magento\Catalog\Model\Product;
use Magento\Store\Model\ScopeInterface;

class ProductPlugin
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
     * @param Product $subject
     * @param bool $result
     * @return bool
     */
    public function afterIsSaleable(Product $subject, bool $result): bool
    {
        if ($this->dataHelper->skipSaleableCheckPlugin()) {
            return $result;
        }
        $moduleIsEnabled = $this->scopeConfig->getValue(
            Data::CONFIG_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
        if ($moduleIsEnabled && $subject->getData(Data::ATTR_CODE) != null) {
            return false;
        }

        return $result;
    }
}
