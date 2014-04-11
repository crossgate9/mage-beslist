<?php

$_columns = array(
    array('title'=>'Titel', 'class'=>'Crossgate9_Product_Name', 'options'=>array()),
    array('title'=>'Artikelcodefabrikant', 'class'=>'Crossgate9_Product_SKU', 'options'=>array()),
    array('title'=>'Winkelproductcode', 'class'=>'Crossgate9_Product_SKU', 'options'=>array('parent'=>true)),
    array('title'=>'Omschrijving', 'class'=>'Crossgate9_Product_Description', 'options'=>array()),
    array('title'=>'', 'class'=>'Crossgate9_Product_ShortDescription'),
    array('title'=>'Prijs', 'class'=>'Crossgate9_Product_Price', 'options'=>array('type'=>'regular')),
    array('title'=>'', 'class'=>'Crossgate9_Product_Price', 'options'=>array('type'=>'special')),
    array('title'=>'Deeplink', 'class'=>'Crossgate9_Product_Path', 'options'=>array()),
    array('class'=>'Crossgate9_Product_Image', 'options'=>array()),
    array('class'=>'Crossgate9_Product_Category', 'options'=>array()),
    array('class'=>'Crossgate9_Product_Stock', 'options'=>array('in-stock'=>'in-stock description', 'out-of-stock'=>'out-of-stock description')),
    // array('class'=>'Crossgate9_Product_Custom', 'options'=>array('name'=>'brand', 'attribute'=>'brand')),
    // array('class'=>'Crossgate9_Product_Custom', 'options'=>array('name'=>'size', 'attribute'=>'size')),
);
$_filters = array(
    array('field' => 'type_id', 'condition' => array('eq' => 'simple')),
    array('field' => 'status', 'condition' => array('eq' => Mage_Catalog_Model_Product_Status::STATUS_ENABLED)),
);