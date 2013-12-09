<?php

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
	if (isset($_parent_data)) unset($_parent_data);
	$_product = Mage::getModel('catalog/product')->load($_product->getId());
        $_parent_id = Mage::getResourceSingleton('catalog/product_type_configurable')->getParentIdsByChild($_product->getId());
	$_data = $_product->getData();
	$_has_parent = false;
	if (count($_parent_id) === 1) {
		$_has_parent = true;
		$_parent_product = Mage::getModel('catalog/product')->load($_parent_id[0]);
		$_parent_data = $_parent_product->getData();
		if ((int) $_parent_data['status'] === Mage_Catalog_Model_Product_Status::STATUS_DISABLED) continue;
	} else {
		if ((int) $_data['visibility'] === Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE) continue;
		$_parent_Data = $_data;
	}

        foreach ($_parent_data['media_gallery']['images'] as $_idx => $_image) {
            $_parent_data['media_gallery']['images'][$_idx]['file'] = $_media_url . 'catalog/product' . $_image['file'];
        }

        $_record = array(
            'name' => $_data['name'],
            'price' => $_data['price'], // xxx add currency
            'image' => $_parent_data['media_gallery']['images'],
            'short_description' => $_data['short_description'],
            'description' => $_data['description'],
            'path' => $_base_url . $_parent_data['url_path'],
            'sku' => $_data['sku'], // xxx simple product sku
            'category' => '', // xxx category
            'size' => '', // xxx simple product size
	    'brand' => $_product->getAttributeText('brand'),
	    'stock' => ($_data['is_in_stock']) ? '1-2 werkdagen' : '3-5 werkdagen',
            'varient' => $_parent_data['sku'],
	    'size' => ($_has_parent) ? $_product->getAttributeText('size') : 0
        );

	$_records[] = $_record;
    }

    return $_records;
}

function formatPrice($_price) {
    return number_format($_price, 2, '.', ',');
}
