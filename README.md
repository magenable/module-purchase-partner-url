# Purchase From Partner

**Purchase From Partner** is a Magento 2 module that allows you to replace standard `Add to Cart` button with a links to external websites. The module also sends events to Google analytics when clicking on the links, if it is necessary.<br>
Typical use case is redirecting from brand website to retail partner website. Partner url can be defined on product level.


## Installation

### Composer:

Run the following command in Magento 2 root folder

```
composer require magenable/purchase-partner-url
php bin/magento module:enable Magenable_PurchasePartnerUrl
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

## User Guide

### Configuration:

Go to **Stores** > **Settings** > **Configuration** > **Magenable** > **Purchase Partner URL**.

**General Settings**

Set `Enabled` to **YES** if you want the module to work.

Update `Title of Links` with the required text, if it needs.

**Google Analytics**

Set `Enabled` to **YES** if you want after click on links sent events to Google Analytics.

Update `Event Category` with the required value, if it needs.

Update `Event Action` with the required value, if it needs.

After changing any setting need to flush cache: for it go to **System** -> **Cache Management** and click `Flush Magento Cache`.

![purchase-partner-url-configuration](https://user-images.githubusercontent.com/34573954/130889492-54b59101-5b76-43dc-a697-71398b64d959.png)

### Adding Purchase Partner Url:

Open any product and add `Purchase Partner Url` items, fill the fields:

- Link; (required)
- Link Title; (if this field not filled then on storefront displaying value from the `Title of Links` field from the configuration of module)
- Event Category (Google Analytics); (if this field not filled then using value from the `Event Category` field from the configuration of module)
- Event Action (Google Analytics); (if this field not filled then using value from the `Event Action` field from the configuration of module)

Then save product.

![purchase-partner-url-product-fill](https://user-images.githubusercontent.com/34573954/130890434-4b452349-5170-41f0-8b85-2d72d164ed90.png)

### Storefront view:

- If the product is filled with only one link, then after clicking on the button there will be a transition to this link.

![purchase-partner-url-result-list](https://user-images.githubusercontent.com/34573954/130891887-6ddea932-c424-480f-9dae-21c2733c8713.png)
![purchase-partner-url-result-view](https://user-images.githubusercontent.com/34573954/130892282-74d5879d-7323-49e9-9d2c-f744bf90d4b1.png)

- If product filled with multiple links then after clicking on the button appear drop-down with links, after clicking on which performs transition.

![purchase-partner-url-result-list-2](https://user-images.githubusercontent.com/34573954/130892217-9add2c9d-abe7-4b6b-82c2-a1e3c8af0d4c.png)
![purchase-partner-url-result-view-2](https://user-images.githubusercontent.com/34573954/130892305-37ebba04-4a94-4e55-a852-2e07558c7ac6.png)

- Also, after clicking on link occurs sending event to Google Analytics (if this not disabled in configuration of module and Google Analytics module is enabled, and configured).
