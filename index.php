<?php

// specific store view
$_store_id = '0';
if (isset($argv[1])) {
    $_store_id = $argv[1];
}
$_export_all_store = (($_store_id === NULL) || ($_store_id === '0'));

require_once '../app/Mage.php';
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
<?php echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<Products>
    <?php foreach ($_records as $_entry): ?>
    <Product>
        <Titel><?php echo $_entry['name']; ?></Titel>
        <Artikelcodefabrikant><?php echo $_entry['sku']; ?></Artikelcodefabrikant>
        <Omschrijving><?php echo $_entry['description']; ?></Omschrijving>
        <Prijs><?php echo formatPrice($_entry['price']); ?></Prijs>
        <Levertijd><?php echo $_entry['stock']; ?></Levertijd>
        <Deeplink><?php echo $_entry['path']; ?></Deeplink>
        <?php foreach ($_entry['image'] as $_idx => $_image): ?>
        <?php if ($_idx === 0): ?>
        <Image><?php echo $_image['file']; ?></Image>
        <?php else: ?>
        <Image<?php echo $_idx; ?>><?php echo $_image['file']; ?></Image<?php echo $_idx;?>>
        <?php endif; ?>
        <?php endforeach; ?>

        <Categorie></Categorie>
        <Merk><?php echo $_entry['brand']; ?></Merk>
        <Portokosten>0</Portokosten>
        <Winkelproductcode><?php echo $_entry['varient']; ?></Winkelproductcode>
	<Maat><?php echo $_entry['size'] ?></Maat>
    </Product>
    <?php endforeach;?>
</Products>

