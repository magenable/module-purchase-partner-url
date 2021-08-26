# Purchase From Partner

**Purchase From Partner** is a Magento 2 module that allows you to replace standard `Add to Cart` button with links to external websites where visitors may purchase the products. Think about Amazon affiliate store, cases when a brand has products available exlusive to retail partners. The module may sends events to Google analytics when clicking on the links for tracking/reporting.<br>
There may be one or more partner URL per product. The URLs are defined on product level, so some of your product may have normal Add to cart and some partner links.


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

Set `Enabled` to **YES** if you want sent events to Google Analytics after partner links clicked .

Update `Event Category` Google Analytic property with the your value, if you wish.

Update `Event Action` Google Analytic property with the your value, if you wish.

After changing any setting you need to flush cache: for it go to **System** -> **Cache Management** and click `Flush Magento Cache`.

![purchase-partner-url-configuration](https://user-images.githubusercontent.com/34573954/130889492-54b59101-5b76-43dc-a697-71398b64d959.png)

### Adding Purchase Partner Url:

Open any product and add `Purchase Partner Url` items, fill the fields:

- Link; (required)
- Link Title; (if this field is not filled then the value from the `Title of Links` field from the module configuration is displayed)
- Event Category (Google Analytics); (if this field is not filled then the value from the `Event Category` field from the module configuration is used)
- Event Action (Google Analytics); (if this field is not filled then the value from the `Event Action` field from the module configuration is used)

Then save the product.

![purchase-partner-url-product-fill](https://user-images.githubusercontent.com/34573954/130890434-4b452349-5170-41f0-8b85-2d72d164ed90.png)

### Storefront view:

- If the only one link set for a product, then after clicking on the button users go to a partner website.

![purchase-partner-url-result-list](https://user-images.githubusercontent.com/34573954/130891887-6ddea932-c424-480f-9dae-21c2733c8713.png)
![purchase-partner-url-result-view](https://user-images.githubusercontent.com/34573954/130892282-74d5879d-7323-49e9-9d2c-f744bf90d4b1.png)

- If there are multiple links defined for a product, after clicking on the button, drop-down with all partner links apppears, after clicking one of them users go to a selected partner website.

![purchase-partner-url-result-list-2](https://user-images.githubusercontent.com/34573954/130892217-9add2c9d-abe7-4b6b-82c2-a1e3c8af0d4c.png)
![purchase-partner-url-result-view-2](https://user-images.githubusercontent.com/34573954/130892305-37ebba04-4a94-4e55-a852-2e07558c7ac6.png)

- Also, after clicking on a link the event is sent to Google Analytics (if this not disabled in configuration of module and Google Analytics module is enabled and configured).
