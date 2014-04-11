<?php

class Crossgate9_Product_Utility {
  public static function isVisible($_product) {
    assert(get_class($_product) === 'Mage_Catalog_Model_Product');
    return !((int) $_product->getData('visibility') === Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE);
  }

  public static function isEnabled($_product) {
    assert(get_class($_product) === 'Mage_Catalog_Model_Product');
    return !((int) $_product->getData('status') === Mage_Catalog_Model_Product_Status::STATUS_DISABLED);
  }

  public static function getParent($_product, $_store_id) {
    $_parent_ids = Mage::getResourceSingleton('catalog/product_type_configurable')->getParentIdsByChild($_product->getId());

    switch (count($_parent_ids)) {
      case 0:
        return false;
        break;
      case 1:
        return Mage::getModel('catalog/product')->setStoreId($_store_id)->load($_parent_ids[0]);
      default:
        return false;
        break;
    }
  }
}