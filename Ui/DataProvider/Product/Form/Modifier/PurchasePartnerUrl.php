<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\Stdlib\ArrayManager;
use Magenable\PurchasePartnerUrl\Helper\Data;
use Magento\Ui\Component\Container;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\Form\Field;

class PurchasePartnerUrl extends AbstractModifier
{
    /**
     * @var LocatorInterface
     */
    private $locator;

    /**
     * @var ArrayManager
     */
    private $arrayManager;

    /**
     * @var array
     */
    private $meta = [];

    /**
     * @var string
     */
    protected $scopeName;

    /**
     * @param LocatorInterface $locator
     * @param ArrayManager $arrayManager
     * @param string $scopeName
     */
    public function __construct(
        LocatorInterface $locator,
        ArrayManager $arrayManager,
        $scopeName = ''
    ) {
        $this->locator = $locator;
        $this->arrayManager = $arrayManager;
        $this->scopeName = $scopeName;
    }

    /**
     * @inheritDoc
     */
    public function modifyData(array $data): array
    {
        $model = $this->locator->getProduct();
        $purchasePartnerUrlData = $model->getData(Data::ATTR_CODE);

        if ($purchasePartnerUrlData) {
            $path = $model->getId() . '/' . self::DATA_SOURCE_DEFAULT . '/' . Data::ATTR_CODE;
            $data = $this->arrayManager->set($path, $data, $purchasePartnerUrlData);
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function modifyMeta(array $meta)
    {
        $this->meta = $meta;
        $this->initPurchasePartnerUrlFields();
        return $this->meta;
    }

    /**
     * @return $this
     */
    protected function initPurchasePartnerUrlFields()
    {
        $purchasePartnerUrlPath = $this->arrayManager->findPath(
            Data::ATTR_CODE,
            $this->meta,
            null,
            'children'
        );

        if ($purchasePartnerUrlPath) {
            $this->meta = $this->arrayManager->merge(
                $purchasePartnerUrlPath,
                $this->meta,
                $this->getPurchasePartnerUrlStructure($purchasePartnerUrlPath)
            );
            $this->meta = $this->arrayManager->set(
                $this->arrayManager->slicePath($purchasePartnerUrlPath, 0, -3)
                . '/' . Data::ATTR_CODE,
                $this->meta,
                $this->arrayManager->get($purchasePartnerUrlPath, $this->meta)
            );
            $this->meta = $this->arrayManager->remove(
                $this->arrayManager->slicePath($purchasePartnerUrlPath, 0, -2),
                $this->meta
            );
        }

        return $this;
    }

    /**
     * @param string $purchasePartnerUrlPath
     * @return array
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function getPurchasePartnerUrlStructure(string $purchasePartnerUrlPath): array
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'componentType' => 'dynamicRows',
                        'label' => __('Purchase Partner Url'),
                        'renderDefaultRecord' => false,
                        'recordTemplate' => 'record',
                        'dataScope' => '',
                        'dndConfig' => [
                            'enabled' => false
                        ],
                        'disabled' => false,
                        'required' => false,
                        'sortOrder' => $this->arrayManager->get(
                            $purchasePartnerUrlPath . '/arguments/data/config/sortOrder',
                            $this->meta
                        )
                    ]
                ]
            ],
            'children' => [
                'record' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => Container::NAME,
                                'isTemplate' => true,
                                'is_collection' => true,
                                'component' => 'Magento_Ui/js/dynamic-rows/record',
                                'dataScope' => ''
                            ]
                        ]
                    ],
                    'children' => [
                        'link' => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'formElement' => Input::NAME,
                                        'componentType' => Field::NAME,
                                        'dataType' => Text::NAME,
                                        'label' => __('Link'),
                                        'dataScope' => 'link',
                                        'placeholder' => 'https://example.com/link/',
                                        'validation' => [
                                            'required-entry' => true
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        'link_title' => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'formElement' => Input::NAME,
                                        'componentType' => Field::NAME,
                                        'dataType' => Text::NAME,
                                        'label' => __('Link Title'),
                                        'dataScope' => 'link_title',
                                        'placeholder' => 'Text Of Button'
                                    ]
                                ]
                            ]
                        ],
                        'event_category' => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'formElement' => Input::NAME,
                                        'componentType' => Field::NAME,
                                        'dataType' => Text::NAME,
                                        'label' => __('Event Category (Google Analytics)'),
                                        'dataScope' => 'event_category',
                                        'placeholder' => 'Event Category'
                                    ]
                                ]
                            ]
                        ],
                        'event_action' => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'formElement' => Input::NAME,
                                        'componentType' => Field::NAME,
                                        'dataType' => Text::NAME,
                                        'label' => __('Event Action (Google Analytics)'),
                                        'dataScope' => 'event_action',
                                        'placeholder' => 'Event Action'
                                    ]
                                ]
                            ]
                        ],
                        'actionDelete' => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'componentType' => 'actionDelete',
                                        'dataType' => Text::NAME,
                                        'label' => ''
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}
