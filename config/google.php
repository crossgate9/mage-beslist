<?php

$_columns = array(
    array('title'=>'Titel', 'class'=>'Crossgate9_Product_Name', 'options'=>array()),
    array('title'=>'Artikelcodefabrikant', 'class'=>'Crossgate9_Product_SKU', 'options'=>array()),
    array('title'=>'Variant_code', 'class'=>'Crossgate9_Product_SKU', 'options'=>array('parent'=>false)),
    array('title'=>'Omschrijving', 'class'=>'Crossgate9_Product_Description', 'options'=>array()),
    array('title'=>'', 'class'=>'Crossgate9_Product_ShortDescription'),
    array('title'=>'Prijs', 'class'=>'Crossgate9_Product_Price', 'options'=>array('type'=>'regular')),
    array('title'=>'Prijs-was', 'class'=>'Crossgate9_Product_Price', 'options'=>array('type'=>'special')),
    array('title'=>'Deeplink', 'class'=>'Crossgate9_Product_Path', 'options'=>array()),
    array('title'=>'Image', 'class'=>'Crossgate9_Product_Image', 'options'=>array()),
    array('title'=>'Categorie', 'class'=>'Crossgate9_Product_Category', 'options'=>array()),
    array('title'=>'Stock', 'class'=>'Crossgate9_Product_Stock', 'options'=>array('in-stock'=>'in stock', 'out-of-stock'=>'out stock')),
    array('title'=>'Color', 'class'=>'Crossgate9_Product_Custom', 'options'=>array('name'=>'color', 'attribute'=>'color', 'post'=>function($_str) { return end(explode(';', $_str)); })),
    // array('title'=>'Merk', 'class'=>'Crosskgate9_Product_Custom', 'options'=>array('name'=>'brand', 'attribute'=>'brand')),
    // array('title'=>'Maat', 'class'=>'Crossgate9_Product_Custom', 'options'=>array('name'=>'size', 'attribute'=>'size')),
);
$_filters = array(
    array('field' => 'type_id', 'condition' => array('eq' => 'simple')),
    array('field' => 'status', 'condition' => array('eq' => Mage_Catalog_Model_Product_Status::STATUS_ENABLED)),
);