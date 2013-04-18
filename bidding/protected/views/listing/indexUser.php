<?php
$this->layout = '//layouts/column1';
$this->breadcrumbs = array(
    'My Listings',
);

$this->menu = array(
    array('label' => 'Create Listing', 'url' => array('create')),
    array('label' => 'Manage Listing', 'url' => array('admin')),
);
?>

<h1>My Listings</h1>
<div class="span16">
    <?
    $this->widget('zii.widgets.grid.CGridView', array(
        /* 'type'=>'striped bordered condensed', */
        'htmlOptions' => array('class' => 'table'),
        'dataProvider' => $dataProvider,
        'columns' => array(
            array('name' => 'id', 'header' => '#', 'sortable' => 'true'),
            array('name' => 'listingHeading', 'sortable' => 'true'),
            array('name' => 'price', 'sortable' => 'true'),
            array('name' => 'orderType', 'sortable' => 'true'),
            array('name' => 'commodityName', 'sortable' => 'true'),
            array('name' => 'productType', 'sortable' => 'true'),
            array('name' => 'orderQty', 'sortable' => 'true'),
            array('name' => 'deliveryDate', 'sortable' => 'true'),
            array('name' => 'paymentDate', 'sortable' => 'true'),
            array('name' => 'paymentTerms', 'sortable' => 'true'),
            array('name' => 'expireTime', 'sortable' => 'true', 'header' => 'Expiry Date'),
            array('name' => 'tradeType', 'sortable' => 'true'),
            array('name' => 'specialRequirments', 'sortable' => 'false'),
            array('name' => 'deliveryAddress', 'sortable' => 'false'),
            array('name' => 'status', 'sortable' => 'true'),
            array('type' => 'raw', 'sortable' => 'true', 'header' => 'Lattitude & Longitude', 'value' => '$data->lat." ,".$data->long'),
            array('type' => 'raw', 'sortable' => 'true', 'header' => 'Delivery within(Kms)', 'value' => 'empty($data->kms) || $data->kms == 0 ? "Not specified" : $data->kms'),
            array('type' => 'raw', 'header' => 'Location', 'sortable' => 'true', 'value' => 'ucfirst(City::model()->getNameById($data->city)).", ".ucfirst(State::model()->getNameById($data->state))'),
            array('type' => 'raw', 'header' => 'Edit', 'sortable' => 'true', 'value' => 'CHtml::link("Edit Listing",array("listing/update","id"=>$data->id))'),
        ),
    ));
    ?>
</div>