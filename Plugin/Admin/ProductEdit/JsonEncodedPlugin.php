<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Plugin\Admin\ProductEdit;

use Magenable\PurchasePartnerUrl\Helper\Data;
use Magento\Eav\Model\Entity\Attribute\Backend\JsonEncoded;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\DataObject;

class JsonEncodedPlugin
{
    private RequestInterface $request;
    private Http $httpRequest;

    public function __construct(
        RequestInterface $request,
        Http $httpRequest,
    ) {
        $this->request = $request;
        $this->httpRequest = $httpRequest;
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
        if ($attrCode !== Data::ATTR_CODE) {
            return $result;
        }
        if ($this->httpRequest->getControllerName() !== 'product' || $this->httpRequest->getActionName() !== 'save') {
            return $result;
        }
        if (!$object->hasData($attrCode)) {
            return $result;
        }
        $post = $this->request->getPost();
        if (!isset($post['product'][$attrCode])) {
            $object->setData($attrCode, null);
        }

        return $result;
    }
}
