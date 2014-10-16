<?php

class Crossgate9_Product_Name extends Crossgate9_Product_Abstract {
  public function __construct() {
    $this->_column_name = 'name';
  }

  public function getValue($_options = array()) {
    $_product = $this->_entities['product'];

    $_prefix = isset($_options['prefix']) ? $_options['prefix'] : '';
    $_suffix = isset($_options['suffix']) ? $_options['suffix'] : '';

    $this->_value = $_prefix . $_product->getData('name') . $_suffix;
    return $this->_value;
  }
}