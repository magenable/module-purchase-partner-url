<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Plugin;

use Magento\Framework\View\LayoutFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magenable\PurchasePartnerUrl\ViewModel\ViewModel;
use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Model\Product;
use Magento\Store\Model\ScopeInterface;
use Magenable\PurchasePartnerUrl\Helper\Data;
use Magenable\PurchasePartnerUrl\Block\Product\ListProduct;

class AbstractProductPlugin
{
    /**
     * @var LayoutFactory
     */
    private $layoutFactory;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var ViewModel
     */
    private $viewModel;

    /**
     * @param LayoutFactory $layoutFactory
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        LayoutFactory $layoutFactory,
        ScopeConfigInterface $scopeConfig,
        ViewModel $viewModel
    ) {
        $this->layoutFactory = $layoutFactory;
        $this->scopeConfig = $scopeConfig;
        $this->viewModel = $viewModel;
    }

    /**
     * @param AbstractProduct $subject
     * @param mixed $result
     * @param Product $product
     * @return mixed
     */
    public function afterGetProductDetailsHtml(AbstractProduct $subject, $result, Product $product)
    {
        $moduleIsEnabled = $this->scopeConfig->getValue(
            Data::CONFIG_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
        if ($moduleIsEnabled && $product->getData(Data::ATTR_CODE)) {
            $output = $this->layoutFactory->create()
                ->createBlock(
                    ListProduct::class,
                    'magenable.purchase.partner.url.list.view',
                    ['data' => [
                        'view_model' => $this->viewModel
                    ]]
                )
                ->setProduct($product)
                ->toHtml();

            $result .= $output;
        }

        return $result;
    }
}
