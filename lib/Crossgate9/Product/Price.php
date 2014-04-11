<?php

class Crossgate9_Product_Price extends Crossgate9_Product_Abstract {
  public function __construct() {
    $this->_column_name = 'price';
  }

  public function getValue($_options = array()) {
    $_type = isset($_options['type']) ? $_options['type'] : 'regular';

    $_product = $this->_entities['product'];

    switch($_type) {
      case 'regular':
        $this->_value = Crossgate9_Utility::formatPrice($_product->getData('price'));
        break;
    }

    return $this->_value;
  }
}