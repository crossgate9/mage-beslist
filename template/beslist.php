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