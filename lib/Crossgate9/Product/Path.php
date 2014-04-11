<?php

class Crossgate9_Product_Path extends Crossgate9_Product_Abstract {
  public function __construct() {
    $this->_column_name = 'path';
  }

  public function getValue($_options = array()) {
    $_store_id = $this->_entities['product']->getData('store_id');
    $_data = $this->getParent();
    if ($_data === self::SKIP_RECORD) return $_data;
    $_data = $_data->getData();

    $this->_value = Mage::app()->getStore($_store_id)->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK) . $_data['url_path'];
    return $this->_value;
  }
}