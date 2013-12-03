<?php

// specific store view
$_store_id = $argv[1];
$_export_all_store = ($_store_id === NULL);

require_once './app/Mage.php';
require_once 'utility.php';
Mage::app();

if ($_export_all_store) {
    $_websites = Mage::app()->getWebsites();
    foreach ($_websites as $_website) {
        $_groups = $_website->getGroups();
        foreach ($_groups as $_group) {
            $_stores = $_group->getStores();
            foreach ($_stores as $_store) {
                $_store_id = $_store->getData('store_id');
                $_records = getRecords($_store_id);
            }
        }
    }
} else {
    $_records = getRecords($_store_id);
}
?>

<?xml version="1.0" encoding="utf-8"?>
<Products>
    <?php foreach ($_records as $_entry): ?>
    <Product>
        <Categorie></Categorie>
        <Merk></Merk>
        <Title><?php echo $_entry['name']; ?></Title>
        <Price><?php echo $_entry['price']; ?></Price>
        
        <?php foreach ($_entry['image'] as $_idx => $_image): ?>
        <?php if ($_idx === 0): ?>
        <Image><?php echo $_image['file']; ?></Image>
        <?php else: ?>
        <Image<?php echo $_idx; ?>><?php echo $_image['file']; ?></Image<?php echo $_idx;?>>
        <?php endif; ?>
        <?php endforeach; ?>

        <Url><?php echo $_entry['path']; ?></Url>
        <Description><?php echo $_entry['description']; ?></Description>
        <Productcode><?php echo $_entry['sku']; ?></Productcode>
    </Product>
    <?php endforeach;?>
</Products>

