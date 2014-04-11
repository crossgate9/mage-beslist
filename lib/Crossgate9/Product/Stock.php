<?php

class Crossgate9_Product_Stock extends Crossgate9_Product_Abstract {
  public function __construct() {
    $this->_column_name = 'stock';
  }

  public function getValue($_options = array()) {
    $_product = $this->_entities['product'];
    $this->_value = $_product->getData('is_in_stock') ? $_options['in-stock'] : $_options['out-of-stock'];
    return $this->_value;
  }
}