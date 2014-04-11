<?php

class Crossgate9_Product_ShortDescription extends Crossgate9_Product_Abstract {
  public function __construct() {
    $this->_column_name = 'short_description';
  }

  public function getValue($_options = array()) {
    $_product = $this->_entities['product'];
    $this->_value = $_product->getData('short_description');
    return $this->_value;
  }
}