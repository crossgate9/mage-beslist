<?php

class Crossgate9_Product_Image extends Crossgate9_Product_Abstract {
  public function __construct() {
    $this->_column_name = 'image';
  }

  public function getValue($_options = array()) {
    $_store_id = $this->_entities['product']->getData('store_id');
    $_data = $this->getParent();
    if ($_data === self::SKIP_RECORD) return $_data;
    $_data = $_data->getData();

    $this->_value = array();
    $_base_url = Mage::app()->getStore($_store_id)->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);

    foreach($_data['media_gallery']['images'] as $_idx => $_image) {
      $this->_value[$_idx]['file'] = $_base_url . 'catalog/product' . $_image['file'];
    }

    return $this->_value;
  }
}