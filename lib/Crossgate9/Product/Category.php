<?php

class Crossgate9_Product_Category extends Crossgate9_Product_Abstract {
  public function __construct() {
    $this->_column_name = 'category';
  }

  public function getValue($_options = array()) {
    $_mapping = isset($_options['mapping']) ? $_options['mapping'] : array();

    $_store_id = $this->_entities['product']->getData('store_id');
    $_product = $this->getParent();
    if ($_product === self::SKIP_RECORD) return $_product;
    
    $_root_id = Mage::app()->getStore($_store_id)->getRootCategoryId();

    $_category_ids = $_product->getCategoryIds();
    $this->_value = false;
    foreach ($_category_ids as $_category_id) {
      if ($_category_id === $_root_id) continue;
      if ($this->_value === false) {
        $this->_value = Mage::getModel('catalog/category')->load($_category_id)->getName();
      }
      if (isset($_mapping[$_category_id])) {
        $this->_value = $_category_text;
        break;
      }
    }

    return ($this->_value === false) ? '' : $this->_value;
  }
}