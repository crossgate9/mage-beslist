<?php

error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('Asia/Hong_Kong');

require_once './vendor/autoload.php';
use Ulrichsg\Getopt\Getopt;
use Ulrichsg\Getopt\Option;

$getopt = new Getopt(array(
    (new Option(null, 'store', Getopt::REQUIRED_ARGUMENT))->setDescription('Store: [1,2] (The number is store view id)'),
));
$getopt->parse();

$_store = $getopt->getOption('store');

if ($_store === null) { 
    echo $getopt->getHelpText();
    die();
}

define('MAGENTO_ROOT', '../');
$_mage_file = MAGENTO_ROOT . '/app/Mage.php';
require_once $_mage_file;
Mage::app();
require_once './lib/Autoload.php';

include "./config.php";
$_store = json_decode($_store, true);
$_records = array();
foreach ($_store as $_store_id) {
    // add fileter
    $_product_collection = Mage::getResourceModel('catalog/product_collection');
    $_product_filter = new Crossgate9_Filter_Product();
    $_product_filter->setCollection($_product_collection);
    foreach ($_filters as $_filter) {
        $_product_filter->addCondition($_filter['field'], $_filter['condition']);
    }

    // load product
    $_products = $_product_filter->getCollection();
    foreach ($_products as $_product) {
        if (Crossgate9_Product_Utility::isVisible($_product) === false) continue;
        
        $_product = Mage::getModel('catalog/product')->setStoreId($_store_id)->load($_product->getId());

        $_is_skip = false;
        $_record = array();
        foreach ($_columns as $_column) {
            $_field = new $_column['class'];
            $_field->setEntities(array('product' => $_product));
            $_value = $_field->getValue($_column['options']);

            if ($_value === Crossgate9_Field_Abstract::SKIP_RECORD) {
                $_is_skip = true;
                break;
            }
            $_record[$_field->getName()] = $_value;
        }
        if ($_is_skip) continue;
        $_records[] = $_record;
    }
}
?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<Products>
    <?php foreach ($_records as $_entry): ?>
    <Product>
        <Titel><![CDATA[<?php echo $_entry['name']; ?>]]></Titel>
        <Artikelcodefabrikant><![CDATA[<?php echo $_entry['sku']; ?>]]></Artikelcodefabrikant>
        <Omschrijving><![CDATA[<?php echo $_entry['description']; ?>]]></Omschrijving>
        <Prijs><![CDATA[<?php echo $_entry['price']; ?>]]></Prijs>
        <Prijs-was><![CDATA[<?php echo $_entry['special_price'] ?>]]></Prijs-was>
        <Levertijd><![CDATA[<?php echo $_entry['stock']; ?>]]></Levertijd>
        <Deeplink><![CDATA[<?php echo $_entry['path']; ?>]]></Deeplink>
        <?php foreach ($_entry['image'] as $_idx => $_image): ?>
        <?php if ($_idx === 0): ?>
        <Image><![CDATA[<?php echo $_image['file']; ?>]]></Image>
        <?php else: ?>
        <Image<?php echo $_idx; ?>><![CDATA[<?php echo $_image['file']; ?>]]></Image<?php echo $_idx;?>>
        <?php endif; ?>
        <?php endforeach; ?>

        <Categorie><![CDATA[<?php echo $_entry['category']; ?>]]></Categorie>
        <Merk><![CDATA[<?php echo $_entry['brand']; ?>]]></Merk>
        <Portokosten>0</Portokosten>
        <Variant_code><![CDATA[<?php echo $_entry['parent_sku']; ?>]]></Variant_code>
        <Winkelproductcode><![CDATA[<?php echo $_entry['sku']; ?>]]></Winkelproductcode>
    	<Maat><![CDATA[<?php echo $_entry['size'] ?>]]></Maat>
    </Product>
    <?php endforeach;?>
</Products>

