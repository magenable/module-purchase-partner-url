<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Plugin\RestAndSoap;

use Magenable\PurchasePartnerUrl\Helper\Data;
use Magento\Eav\Model\Entity\Attribute\Backend\JsonEncoded;
use Magento\Framework\DataObject;
use Magento\Framework\Serialize\Serializer\Json;

class JsonEncodedPlugin
{
    private Json $jsonSerializer;

    public function __construct(Json $jsonSerializer)
    {
        $this->jsonSerializer = $jsonSerializer;
    }

    /**
     * @param JsonEncoded $subject
     * @param JsonEncoded $result
     * @param DataObject $object
     * @return JsonEncoded
     */
    public function afterAfterLoad(JsonEncoded $subject, JsonEncoded $result, DataObject $object): JsonEncoded
    {
        $attrCode = $subject->getAttribute()->getAttributeCode();
        if ($attrCode !== Data::ATTR_CODE) {
            return $result;
        }

        if ($object->getData($attrCode)) {
            $object->setData(
                $attrCode,
                $this->jsonSerializer->serialize(
                    $object->getData($attrCode)
                )
            );
        } else {
            $object->setData(
                $attrCode,
                null
            );
        }

        return $result;
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
        if (!$object->hasData($attrCode) || !$this->isJsonEncoded($object->getData($attrCode))) {
            return $result;
        }
        $attrData = $this->jsonSerializer->unserialize($object->getData($attrCode));
        if (!$attrData) {
            $object->setData($attrCode, null);
        }

        return $result;
    }

    private function isJsonEncoded($value): bool
    {
        $result = is_string($value);
        if ($result) {
            try {
                $this->jsonSerializer->unserialize($value);
            } catch (\InvalidArgumentException $e) {
                $result = false;
            }
        }

        return $result;
    }
}
