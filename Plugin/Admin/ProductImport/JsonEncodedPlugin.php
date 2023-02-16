<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Plugin\Admin\ProductImport;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Eav\Model\Entity\Attribute\Backend\JsonEncoded;
use Magento\Framework\DataObject;
use Magenable\PurchasePartnerUrl\Helper\Data;

class JsonEncodedPlugin
{
    private RequestInterface $request;
    private Http $httpRequest;
    private Json $jsonSerializer;

    public function __construct(
        RequestInterface $request,
        Http $httpRequest,
        Json $jsonSerializer
    ) {
        $this->request = $request;
        $this->httpRequest = $httpRequest;
        $this->jsonSerializer = $jsonSerializer;
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
        if ($this->httpRequest->getModuleName() !== 'admin') {
            return $result;
        }
        if ($this->httpRequest->getControllerName() !== 'import' || $this->httpRequest->getActionName() !== 'start') {
            return $result;
        }
        if (!$object->hasData($attrCode)) {
            return $result;
        }
        $attrDataUnserialized = $this->jsonSerializer->unserialize($object->getData($attrCode));
        if (!empty($attrDataUnserialized) && is_string($attrDataUnserialized)) {
            throw new \InvalidArgumentException('Incorrect data provided for the attribute ' . Data::ATTR_CODE);
        }
        if (empty($attrDataUnserialized)) {
            $object->setData($attrCode, null);
        }

        return $result;
    }
}
