<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Plugin;

use Magento\Framework\App\RequestInterface;
use Magento\Eav\Model\Entity\Attribute\Backend\JsonEncoded;
use Magento\Framework\DataObject;
use Magenable\PurchasePartnerUrl\Helper\Data;

class JsonEncodedPlugin
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @param RequestInterface $request
     */
    public function __construct(
        RequestInterface $request
    ) {
        $this->request = $request;
    }

    /**
     * @param JsonEncoded $subject
     * @param JsonEncoded $result
     * @param DataObject $object
     * @return JsonEncoded
     */
    public function afterBeforeSave(JsonEncoded $subject, JsonEncoded $result, DataObject $object): JsonEncoded
    {
        $attrCode = $subject->getAttribute()->getAttributeCode();
        if ($attrCode == Data::ATTR_CODE) {
            $post = $this->request->getPost();
            if (!isset($post['product'][$attrCode])) {
                $object->setData($attrCode, null);
            }
        }

        return $result;
    }
}
