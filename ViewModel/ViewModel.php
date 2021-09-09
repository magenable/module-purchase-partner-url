<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\ViewModel;

use Magenable\PurchasePartnerUrl\Helper\Data;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Escaper;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\ScopeInterface;

class ViewModel implements ArgumentInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param Escaper $escaper
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Escaper $escaper
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->escaper = $escaper;
    }

    /**
     * @return string
     */
    public function getDefaultButtonTitle(): string
    {
        return $this->scopeConfig->getValue(
            Data::CONFIG_DEFAULT_TITLE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return int
     */
    public function analyticsIsEnabled(): int
    {
        return (int)$this->scopeConfig->getValue(
            Data::CONFIG_ANALYTICS_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function getDefaultEventCategory(): string
    {
        return $this->scopeConfig->getValue(
            Data::CONFIG_DEFAULT_EVENT_CATEGORY,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function getDefaultEventAction(): string
    {
        return $this->scopeConfig->getValue(
            Data::CONFIG_DEFAULT_EVENT_ACTION,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return int
     */
    public function isOpenLinkInNewTab(): int
    {
        return (int)$this->scopeConfig->getValue(
            Data::CONFIG_OPEN_NEW_TAB,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return Escaper
     */
    public function getEscaper()
    {
        return $this->escaper;
    }
}
