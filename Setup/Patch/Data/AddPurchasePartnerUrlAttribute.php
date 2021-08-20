<?php

namespace Magenable\PurchasePartnerUrl\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Catalog\Model\Product;
use Magenable\PurchasePartnerUrl\Helper\Data;
use Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

class AddPurchasePartnerUrlAttribute implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @param ModuleDataSetupInterface  $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        /** @var Magento\Eav\Setup\EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(
            Product::ENTITY,
            Data::ATTR_CODE,
            [
                'type' => 'text',
                'group' => 'General',
                'label' => 'Purchase Partner Url',
                'attribute_set' => 'Product Details',
                'backend' => ArrayBackend::class,
                'input' => 'text',
                'source' => '',
                'required' => false,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'user_defined' => false,
                'is_visible_on_front' => false,
                'used_in_product_listing' => true
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
