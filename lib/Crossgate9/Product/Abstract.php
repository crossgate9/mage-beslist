<?php

abstract class Crossgate9_Product_Abstract extends Crossgate9_Field_Abstract {
  public function getParent() {
    $_product = $this->_entities['product'];
    $_store_id = $_product->getData('store_id');
    $_parent = Crossgate9_Product_Utility::getParent($_product);
    
    if ($_parent !== false && 
       (Crossgate9_Product_Utility::isVisible($_parent) === false ||
        Crossgate9_Product_Utility::isEnabled($_parent) === false)) {
      return self::SKIP_RECORD;
    }

    return ($_parent === false) ? $_product : $_parent;
  }
}