<?php

function getParentProduct($_product) {
    $_parent_ids = Mage::getResourceSingleton('catalog/product_type_configurable')->getParentIdsByChild($_product->getId());

    // no parent product
    if (count($_parent_ids) === 0) return false;

    if (count($_parent_ids) === 1) {
        // only one parent product
        return Mage::getModel('catalog/product')->load($_parent_ids[0]);
    }

    if (count($_parent_ids) > 1) {
        // xxx more than one parent products
        return false;
    }
}

function isProductVisible($_product) {
    return !((int) $_product->getData('visibility') === Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE);
}

function isProductEnabled($_product) {
    return !((int) $_product->getData('status') === Mage_Catalog_Model_Product_Status::STATUS_DISABLED);
}

function isProductInvalid($_product) {
    $_data = $_product->getData();
    return ((int) $_data['visibility'] === Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE)
        || ((int) $_data['status'] === Mage_Catalog_Model_Product_Status::STATUS_DISABLED);
}

function getRecords($_store_id) {
    $_product_collection = Mage::getResourceModel('catalog/product_collection')
                        -> setStoreId($_store_id)
                        -> addAttributeToFilter('type_id', array('eq' => 'simple'))
            			-> addAttributeToFilter('status', array('eq' => Mage_Catalog_Model_Product_Status::STATUS_ENABLED));

    $_products = $_product_collection->getItems();
    $_records = array();

    $_base_url = Mage::app()->getStore($_store_id)->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK);
    $_media_url = Mage::app()->getStore($_store_id)->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);

    foreach ($_products as $_product) {
        if (isset($_data)) unset($_data);
    	if (isset($_parent_product_data)) unset($_parent_product_data);

    	$_product = Mage::getModel('catalog/product')->load($_product->getId());
        if (isProductEnabled($_product) === false) continue;

        $_parent_product = getParentProduct($_product);
        if ($_parent_product !== false && 
           (isProductEnabled($_parent_product) === false || isProductVisible($_parent_product) == false)) {
            continue;
        }

        if ($_parent_product === false && isProductVisible($_parent_product) === false) {
            continue;
        }

    	$_data = $_product->getData();
        $_parent_product_data = ($_parent_product === false) ? $_data : $_parent_product->getData();
    
        foreach ($_parent_product_data['media_gallery']['images'] as $_idx => $_image) {
            $_parent_product_data['media_gallery']['images'][$_idx]['file'] = $_media_url . 'catalog/product' . $_image['file'];
        }

        $_record = array(
            'name' => $_data['name'],
            'price' => $_data['price'],
            'image' => $_parent_product_data['media_gallery']['images'],
            'short_description' => $_data['short_description'],
            'description' => $_data['description'],
            'path' => $_base_url . $_parent_product_data['url_path'],
            'sku' => $_data['sku'], // xxx simple product sku
            'category' => '', // xxx category
            'size' => '', // xxx simple product size
    	    // 'brand' => $_product->getAttributeText('brand'),
    	    'stock' => ($_data['is_in_stock']) ? '1-2 werkdagen' : '3-5 werkdagen',
            'varient' => $_parent_product_data['sku'],
    	    // 'size' => ($_parent_product !== false) ? $_product->getAttributeText('size') : 0
        );

    	$_records[] = $_record;
    }

    return $_records;
}

function formatPrice($_price) {
    return number_format($_price, 2, '.', ',');
}
