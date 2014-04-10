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
require_once 'utility.php';

$_store = json_decode($_store, true);
$_records = array();
foreach ($_store as $_store_id) {
    $_record = getRecords($_store);
    array_merge($_records, $_record);
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

        <Categorie><?php echo $_entry['category']; ?></Categorie>
        <Merk><?php echo $_entry['brand']; ?></Merk>
        <Portokosten>0</Portokosten>
        <Winkelproductcode><?php echo $_entry['varient']; ?></Winkelproductcode>
	<Maat><?php echo $_entry['size'] ?></Maat>
    </Product>
    <?php endforeach;?>
</Products>

