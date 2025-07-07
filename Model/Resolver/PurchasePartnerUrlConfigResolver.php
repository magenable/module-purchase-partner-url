<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Model\Resolver;

use Magenable\PurchasePartnerUrl\Helper\Data;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Store\Model\ScopeInterface;
use Magento\GoogleAnalytics\Helper\Data as GAHelper;

class PurchasePartnerUrlConfigResolver implements ResolverInterface
{
    /**
     * @var Data
     */
    private Data $dataHelper;

    /**
     * PurchasePartnerUrlResolver constructor.
     * @param Data $dataHelper
     */
    public function __construct(
        Data $dataHelper
    ) {
        $this->dataHelper = $dataHelper;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, ?array $value = null, ?array $args = null)
    {
        return [
            'default_title' => (string)$this->dataHelper->getConfigValue(
                Data::CONFIG_DEFAULT_TITLE,
                ScopeInterface::SCOPE_STORE
            ),
            'show_all_links' => (bool)$this->dataHelper->getConfigValue(
                Data::CONFIG_SHOW_ALL_LINKS,
                ScopeInterface::SCOPE_STORE
            ),
            'open_in_new_tab' => (bool)$this->dataHelper->getConfigValue(
                Data::CONFIG_OPEN_NEW_TAB,
                ScopeInterface::SCOPE_STORE
            ),
            'ga_enabled' => (bool)$this->dataHelper->getConfigValue(
                Data::CONFIG_ANALYTICS_ENABLED,
                ScopeInterface::SCOPE_STORE
            ),
            'ga_account' => (string)$this->dataHelper->getConfigValue(
                GAHelper::XML_PATH_ACCOUNT,
                ScopeInterface::SCOPE_STORE
            )
        ];
    }
}
