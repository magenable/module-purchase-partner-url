<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magenable\PurchasePartnerUrl\Helper\Data;
use Magento\Store\Model\ScopeInterface;

class ViewModel implements ArgumentInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
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
}
