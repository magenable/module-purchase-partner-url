var config = {
    config: {
        mixins: {
            'Magento_Catalog/js/catalog-add-to-cart': {
                'Magenable_PurchasePartnerUrl/js/catalog-add-to-cart-mixin': true
            },
            'Magento_Catalog/js/validate-product': {
                'Magenable_PurchasePartnerUrl/js/validate-product-mixin': true
            }
        }
    }
};