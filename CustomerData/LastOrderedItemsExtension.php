<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\CustomerData;

use Magento\Sales\CustomerData\LastOrderedItems;
use Magento\Sales\Model\Order\Item;
use Magento\Framework\App\ObjectManager;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magenable\PurchasePartnerUrl\Helper\Data;
use Magento\Store\Model\ScopeInterface;

class LastOrderedItemsExtension extends LastOrderedItems
{
    /**
     * @inheritDoc
     */
    protected function isItemAvailableForReorder(Item $orderItem)
    {
        $objectManager = ObjectManager::getInstance();
        $productRepository = $objectManager->get(ProductRepositoryInterface::class);
        $product = $productRepository->getById(
            $orderItem->getProduct()->getId()
        );

        $dataHelper = $objectManager->get(Data::class);
        $moduleIsEnabled = $dataHelper->getConfigValue(
            Data::CONFIG_ENABLED,
            ScopeInterface::SCOPE_STORE
        );

        if ($moduleIsEnabled && $product->getData(Data::ATTR_CODE)) {
            return false;
        }

        return parent::isItemAvailableForReorder($orderItem);
    }
}
