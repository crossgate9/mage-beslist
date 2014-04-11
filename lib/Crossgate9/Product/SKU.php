<?php

class Crossgate9_Product_SKU extends Crossgate9_Product_Abstract {
  public function __construct() {
    $this->_column_name = 'sku';
  }

  public function getValue($_options = array()) {
    $_is_parent = isset($_options['parent']) ? $_options['parent'] : false;

    if ($_is_parent) {
      $_product = $this->getParent();
      if ($_product === self::SKIP_RECORD) return $_product;
      $_this->_column_name = 'parent_sku';
    } else {
      $_product = $this->_entities['product'];
    }
    $this->_value = $_product->getData('sku');
    return $this->_value;
  }
}