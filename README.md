# Purchase From Partner

**Purchase From Partner** is a Magento 2 module that allows you to replace standard `Add to Cart` button with links to external websites where visitors may purchase the products. Think about Amazon affiliate store, cases when a brand has products available exlusive to retail partners. The module may sends events to Google analytics when clicking on the links for tracking/reporting.<br>
There may be one or more partner URL per product. The URLs are defined on product level, so some of your product may have normal Add to cart and some partner links.

The extension supports Magento version 2.3.X and 2.4.X

## PWA Studio
The extension for Magento PWA Studio you can find here: https://www.npmjs.com/package/@magenable/purchase-partner-url

## Installation

### Composer:

Run the following command in Magento 2 root folder

```
composer require magenable/module-purchase-partner-url
bin/magento module:enable Magenable_PurchasePartnerUrl
bin/magento setup:upgrade
bin/magento setup:static-content:deploy
```
## Upgrade

### Composer:

Run the following command in Magento 2 root folder

```
composer update magenable/module-purchase-partner-url
bin/magento setup:upgrade
```

## User Guide

### Configuration:

Go to **Stores** > **Settings** > **Configuration** > **Magenable Extensions** > **Purchase Partner URL**.

**General Settings**

Set `Enabled` to **YES** if you want the module to work.

Update `Title of Links` with the required text, if it needs.

Set `Show All Links at Once` to **YES** if you want all buttons to be displayed at once.

Set `Open Link in New Tab` to **NO** if you want link opens in current tab.

**Google Analytics**

Set `Enabled` to **YES** if you want sent events to Google Analytics after partner links clicked .

Update `Event Category` Google Analytic property with the your value, if you wish.

Update `Event Action` Google Analytic property with the your value, if you wish.

After changing any setting you need to flush cache: for it go to **System** -> **Cache Management** and click `Flush Magento Cache`.

![purchase-partner-url-configuration](https://user-images.githubusercontent.com/34573954/131064786-b6c17755-596f-47a7-8f68-15c2ff3276bf.png)

### Adding Purchase Partner Url:

Open any product and add `Purchase Partner Url` items, fill the fields:

- Link; (required)
- Link Title; (if this field is not filled then the value from the `Title of Links` field from the module configuration is displayed)
- Event Category (Google Analytics); (if this field is not filled then the value from the `Event Category` field from the module configuration is used)
- Event Action (Google Analytics); (if this field is not filled then the value from the `Event Action` field from the module configuration is used)

Then save the product.

![purchase-partner-url-product-fill](https://user-images.githubusercontent.com/34573954/130890434-4b452349-5170-41f0-8b85-2d72d164ed90.png)

### Storefront view:

- If the only one link set for a product (or enabled setting `Show All Links at Once`), then after clicking on the button users go to a partner website.

![purchase-partner-url-result-list](https://user-images.githubusercontent.com/34573954/131065580-af76c1df-eecd-4007-a67a-cc99ac64d12c.png)
![purchase-partner-url-result-view](https://user-images.githubusercontent.com/34573954/131065583-a9b30954-298e-4ea6-b17b-6f6d1612d657.png)

- If there are multiple links defined for a product (and disabled setting `Show All Links at Once`), after clicking on the button, all partner links appears, after clicking one of them users go to a selected partner website.

![purchase-partner-url-result-list-2](https://user-images.githubusercontent.com/34573954/131065629-91150165-1fec-4419-83e7-97df49cd602e.png)
![purchase-partner-url-result-view-2](https://user-images.githubusercontent.com/34573954/131065635-dd53d9a2-2c06-46d4-9e75-3708e980959d.png)

- Also, after clicking on a link the event is sent to Google Analytics (if this not disabled in configuration of module and Google Analytics module is enabled and configured).
