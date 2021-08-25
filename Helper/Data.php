<?php
declare(strict_types=1);

namespace Magenable\PurchasePartnerUrl\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    const ATTR_CODE = 'magenable_purchase_partner_url';

    const CONFIG_ENABLED = 'magenable_purchase_partner_url/general/enabled';

    const CONFIG_DEFAULT_TITLE = 'magenable_purchase_partner_url/general/title';

    const CONFIG_ANALYTICS_ENABLED = 'magenable_purchase_partner_url/analytics/enabled';

    const CONFIG_DEFAULT_EVENT_CATEGORY = 'magenable_purchase_partner_url/analytics/event_category';

    const CONFIG_DEFAULT_EVENT_ACTION = 'magenable_purchase_partner_url/analytics/event_action';

    /**
     * @var bool
     */
    private $skipSaleableCheckPlugin = false;

    /**
     * @param string $path
     * @param string $scopeType
     * @param null|int|string $scopeCode
     * @return mixed
     */
    public function getConfigValue(string $path, string $scopeType, $scopeCode = null)
    {
        return $this->scopeConfig->getValue(
            $path,
            $scopeType,
            $scopeCode
        );
    }

    /**
     * @param bool|null $val
     * @return bool
     */
    public function skipSaleableCheckPlugin(?bool $val = null): bool
    {
        if (!is_null($val)) {
            $this->skipSaleableCheckPlugin = $val;
        }

        return $this->skipSaleableCheckPlugin;
    }
}
