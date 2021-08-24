<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Catalog\Model\Product;
use Magento\Store\Model\ScopeInterface;
use Magenable\PurchasePartnerUrl\Helper\Data;

class ProductPlugin
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param Product $subject
     * @param bool $result
     * @return bool
     */
    public function afterIsSaleable(Product $subject, bool $result): bool
    {
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
