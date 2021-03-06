<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Block\Product;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Catalog\Model\Product;
use Magenable\PurchasePartnerUrl\Helper\Data;
use Magento\Store\Model\ScopeInterface;
use InvalidArgumentException;

class ListProduct extends Template
{
    /**
     * @var Json
     */
    private $jsonSerializer;

    /**
     * @var array
     */
    private $purchasePartnerUrls;

    /**
     * @param Context $context
     * @param Json $jsonSerializer
     * @param array $data
     */
    public function __construct(
        Context $context,
        Json $jsonSerializer,
        array $data = []
    ) {
        $this->jsonSerializer = $jsonSerializer;
        parent::__construct($context, $data);
    }

    /**
     * @var Product $product
     */
    private $product;

    /**
     * @inheritdoc
     */
    public function getTemplate(): string
    {
        $showAllLinks = (int)$this->_scopeConfig->getValue(
            Data::CONFIG_SHOW_ALL_LINKS,
            ScopeInterface::SCOPE_STORE
        );

        if (count($this->getPurchasePartnerUrls()) > 1 && !$showAllLinks) {
            return 'Magenable_PurchasePartnerUrl::product/list-multiple.phtml';
        } else {
            return 'Magenable_PurchasePartnerUrl::product/list.phtml';
        }
    }

    /**
     * @param Product $product
     * @return ListProduct
     */
    public function setProduct(Product $product): ListProduct
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return array
     */
    public function getPurchasePartnerUrls(): array
    {
        if (null === $this->purchasePartnerUrls) {
            $result = $this->getProduct()->getData(Data::ATTR_CODE);
            if ($result && $this->isJsonEncoded($result)) {
                $this->purchasePartnerUrls = $this->jsonSerializer->unserialize($result);
            } else {
                $this->purchasePartnerUrls = [];
            }
        }

        return $this->purchasePartnerUrls;
    }

    /**
     * @return int
     */
    public function getEventValue(): int
    {
        $price = (float)$this->getProduct()->getPrice();
        if ($price < 1) {
            $price = 1;
        } else {
            $price = round($price);
        }

        return (int)$price;
    }

    /**
     * @param string|int|float|bool|array|null $value
     * @return bool
     */
    private function isJsonEncoded($value): bool
    {
        $result = is_string($value);
        if ($result) {
            try {
                $this->jsonSerializer->unserialize($value);
            } catch (InvalidArgumentException $e) {
                $result = false;
            }
        }

        return $result;
    }
}
