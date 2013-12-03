<?php

function getRecords($_store_id) {
    $_product_collection = Mage::getResourceModel('catalog/product_collection')
                        -> setStoreId($_store_id)
                        -> addAttributeToFilter('type_id', array('eq' => 'configurable'));

    $_products = $_product_collection->getItems();
    $_records = array();

    foreach ($_products as $_product) {
        $_product = Mage::getModel('catalog/product')->load($_product->getId());
        $_data = $_product->getData();
        $_records[] = array(
            'name' => $_data['name'],
            'price' => $_data['price'], // xxx add currency
            'image' => $_data['media_gallery']['images'],
            'short_description' => $_data['short_description'],
            'description' => $_data['description'],
            'path' => $_data['url_path'],
            'sku' => $_data['sku'], // xxx simple product sku
            'category' => '', // xxx category
            'size' => '', // xxx simple product size
            'varient' => $_data['sku']
        );
    }

    return $_records;
}

function formatPrice($_price) {
    return number_format($_price, 2, '.', ',');
}