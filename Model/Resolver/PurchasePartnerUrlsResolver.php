<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Model\Resolver;

use Magenable\PurchasePartnerUrl\ViewModel\ViewModel;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magenable\PurchasePartnerUrl\Helper\Data;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Store\Model\ScopeInterface;

class PurchasePartnerUrlsResolver implements ResolverInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;

    /**
     * @var ViewModel
     */
    private ViewModel $viewModel;

    /**
     * @var Data
     */
    private Data $dataHelper;

    /**
     * PurchasePartnerUrlsResolver constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param ViewModel $viewModel
     * @param Data $dataHelper
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        ViewModel $viewModel,
        Data $dataHelper
    ) {
        $this->productRepository = $productRepository;
        $this->viewModel = $viewModel;
        $this->dataHelper = $dataHelper;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, ?array $value = null, ?array $args = null): array
    {
        $result = [];
        if (!$this->dataHelper->getConfigValue(Data::CONFIG_ENABLED, ScopeInterface::SCOPE_STORE)) {
            return $result;
        }

        $product = $this->productRepository->getById($value['entity_id']);
        $purchasePartnerUrlItems = $product->getData(Data::ATTR_CODE);
        if (empty($purchasePartnerUrlItems)) {
            return $result;
        }

        foreach ($purchasePartnerUrlItems as $urlItem) {
            unset($urlItem['record_id']);
            if (empty($urlItem['link_title'])) {
                $urlItem['link_title'] = $this->viewModel->getDefaultButtonTitle();
            }
            if (empty($urlItem['event_action'])) {
                $urlItem['event_action'] = $this->viewModel->getDefaultEventAction();
            }
            if (empty($urlItem['event_category'])) {
                $urlItem['event_category'] = $this->viewModel->getDefaultEventCategory();
            }
            $result[] = $urlItem;
        }

        return $result;
    }
}
