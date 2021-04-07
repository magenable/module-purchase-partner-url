# Purchase From Partner

**Purchase From Partner** is a Magento 2 module that allows you to replace standard Add to Cart button with a link to external website. <br>
Typical use case is redirecting from brand website to retail partner website. Partner url can be definef on product level.

<br />

## Installation

### Composer

Run the following command in Magento 2 root folder

```
composer require magenable/purchase-partner-url
php bin/magento module:enable Magenable_PurchasePartnerUrl
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```
<br />

## User Guide

### Configuration

Go to Stores > Settings > Configuration > Magenable > Purchase Partner URL.

**General Settings**

Set **Enabled** to 'YES'.
After changing settings need to flush cache: Go to System -> Cache Management and click **Flush Magento Cache**.

![purchase-partner-url-general-settings](https://user-images.githubusercontent.com/34573954/113534675-5e40a180-960c-11eb-9c56-78a45e89bf5b.png)

### Adding Purchase Partner Url

Open any product and fill **Purchase Partner Url** field.

![purchase-partner-url-product-fill](https://user-images.githubusercontent.com/34573954/113534676-600a6500-960c-11eb-9251-ab8053c38ba7.png)

## Final result
![purchase-partner-url-result-list](https://user-images.githubusercontent.com/34573954/113534678-613b9200-960c-11eb-8bbb-f4ab7c0066ac.png)
![purchase-partner-url-result-view](https://user-images.githubusercontent.com/34573954/113534677-60a2fb80-960c-11eb-972a-9c8bbbddb88b.png)
