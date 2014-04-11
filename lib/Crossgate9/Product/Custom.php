<?php

class Crossgate9_Product_Custom extends Crossgate9_Product_Abstract {
  public function __construct() {
    $this->_column_name = 'custom';
  }

  public function getValue($_options = array()) {
    $_product = $this->_entities['product'];
    $this->_column_name = $_options['name'];
    $_attribute_name = $_options['attribute'];

    $this->_value = $_product->getResource()->getAttribute($_attribute_name)->getFrontend()->getValue($_product);

    return $this->_value;
  }
}