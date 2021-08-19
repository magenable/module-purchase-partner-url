<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Model;

class CurrentProducts
{
    /**
     * @var array
     */
    private $sku = [];

    /**
     * @param mixed $sku
     */
    public function addSku($sku)
    {
        if (!in_array($sku, $this->sku)) {
            $this->sku[] = $sku;
        }
    }

    /**
     * @return array
     */
    public function getAllSku()
    {
        return $this->sku;
    }
}
