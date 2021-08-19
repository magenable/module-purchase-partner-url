<?php

namespace Magenable\PurchasePartnerUrl\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magenable\PurchasePartnerUrl\Model\CurrentProducts;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magenable\PurchasePartnerUrl\Helper\Data;

class PartnerUrl extends Template
{
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    private $productCollectionFactory;

    /**
     * @var \Magenable\PurchasePartnerUrl\Model\CurrentProducts
     */
    private $currentProducts;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Magenable\PurchasePartnerUrl\Model\CurrentProducts $currentProducts
     */
    public function __construct(
        Context $context,
        CollectionFactory $productCollectionFactory,
        CurrentProducts $currentProducts
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->currentProducts = $currentProducts;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getProducts()
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect(Data::ATTR_CODE)
            ->addAttributeToFilter(
                Data::ATTR_CODE,
                ['neq' => 'NULL']
            )->addAttributeToFilter(
                'sku',
                ['in' => $this->currentProducts->getAllSku()]
            );

        return $collection;
    }
}
