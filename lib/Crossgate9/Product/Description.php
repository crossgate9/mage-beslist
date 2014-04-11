<?php

class Crossgate9_Product_Description extends Crossgate9_Product_Abstract {
  public function __construct() {
    $this->_column_name = 'description';
  }

  public function getValue($_options = array()) {
    $_product = $this->_entities['product'];
    $this->_value = $_product->getData('description');
    return $this->_value;
  }
}