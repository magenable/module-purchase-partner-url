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
        return 'Magenable_PurchasePartnerUrl::product/list.phtml';
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
     * @return string
     */
    public function getDefaultButtonTitle(): string
    {
        return $this->_scopeConfig->getValue(
            Data::CONFIG_DEFAULT_TITLE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return array
     */
    public function getPurchasePartnerUrls(): array
    {
        $result = $this->getProduct()->getData(Data::ATTR_CODE);
        if ($result && $this->isJsonEncoded($result)) {
            return $this->jsonSerializer->unserialize($result);
        }

        return [];
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