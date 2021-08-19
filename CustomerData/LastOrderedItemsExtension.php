<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\CustomerData;

use Magento\Sales\CustomerData\LastOrderedItems;
use Magento\Sales\Model\Order\Item;
use Magento\Framework\App\ObjectManager;
use Magenable\PurchasePartnerUrl\Helper\Data;

class LastOrderedItemsExtension extends LastOrderedItems
{
    /**
     * @inheritDoc
     */
    protected function isItemAvailableForReorder(Item $orderItem)
    {
        $objectManager = ObjectManager::getInstance();
        $productRepositoy = $objectManager->get('Magento\Catalog\Api\ProductRepositoryInterface');
        $product = $productRepositoy->getById(
            $orderItem->getProduct()->getId()
        );

        if ($product->getCustomAttribute(Data::ATTR_CODE) != null) {
            return false;
        }

        return parent::isItemAvailableForReorder($orderItem);
    }
}
