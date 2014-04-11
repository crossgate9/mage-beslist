<?php

class Crossgate9_Product_Name extends Crossgate9_Product_Abstract {
  public function __construct() {
    $this->_column_name = 'name';
  }

  public function getValue($_options = array()) {
    $_product = $this->_entities['product'];
    $this->_value = $_product->getData('name');
    return $this->_value;
  }
}