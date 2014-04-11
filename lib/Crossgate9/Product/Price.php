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
      case 'special':
        $_special_price = $_product->getData('special_price');
        if (isset($_special_price) === false) {
          $_special_price = $_product->getData('price');
        }
        $this->_value = $_special_price;
        break;
      default:
        $this->_value = Crossgate9_Utility::formatPrice($_product->getData('price'));
        break;
    }

    return $this->_value;
  }
}