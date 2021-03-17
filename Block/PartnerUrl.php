<?php

namespace Magenable\PurchasePartnerUrl\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magenable\PurchasePartnerUrl\Setup\Patch\Data\AddPurchasePartnerUrlAttribute;

class PartnerUrl extends Template
{
    /**
     * @param Context $context
     * @param CollectionFactory $productCollectionFactory
     */
    public function __construct(
        Context $context,
        CollectionFactory $productCollectionFactory
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        parent::__construct($context);
    }

    /**
     * @return Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getProducts()
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect(AddPurchasePartnerUrlAttribute::ATTR_CODE)
            ->addAttributeToFilter(
                AddPurchasePartnerUrlAttribute::ATTR_CODE,
                ['neq' => 'NULL']
            );

        return $collection;
    }
}
