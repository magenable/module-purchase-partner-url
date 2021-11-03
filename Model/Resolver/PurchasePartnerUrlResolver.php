<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Model\Resolver;

use Magenable\PurchasePartnerUrl\Helper\Data;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Store\Model\ScopeInterface;

class PurchasePartnerUrlResolver implements ResolverInterface
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

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null): bool
    {
        if ($field->getName() === 'purchase_partner_url_show_all_links') {
            return (bool)$this->dataHelper->getConfigValue(
                Data::CONFIG_SHOW_ALL_LINKS,
                ScopeInterface::SCOPE_STORE
            );
        }
        if ($field->getName() === 'purchase_partner_url_open_in_new_tab') {
            return (bool)$this->dataHelper->getConfigValue(
                Data::CONFIG_OPEN_NEW_TAB,
                ScopeInterface::SCOPE_STORE
            );
        }
        if ($field->getName() === 'purchase_partner_url_ga_enabled') {
            return (bool)$this->dataHelper->getConfigValue(
                Data::CONFIG_ANALYTICS_ENABLED,
                ScopeInterface::SCOPE_STORE
            );
        }
    }
}
