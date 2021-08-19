<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Plugin;

use Magenable\PurchasePartnerUrl\Model\CurrentProducts;
use Magento\Catalog\Model\Product as ModelProduct;

class Product
{
    /**
     * @var \Magenable\PurchasePartnerUrl\Model\CurrentProducts
     */
    private $currentProducts;

    /**
     * @param \Magenable\PurchasePartnerUrl\Model\CurrentProducts $currentProducts
     */
    public function __construct(
        CurrentProducts $currentProducts
    ) {
        $this->currentProducts = $currentProducts;
    }

    /**
     * @param \Magento\Catalog\Model\Product $subject
     * @param string $result
     * @return string
     */
    public function afterGetSku(ModelProduct $subject, string $result): string
    {
        $this->currentProducts->addSku($result);

        return $result;
    }
}
