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

<h1>My Received Bids</h1>
<div class="span12">
    <?
    $this->widget('zii.widgets.grid.CGridView', array(
        /* 'type'=>'striped bordered condensed', */
        'htmlOptions' => array('class' => 'table'),
        'dataProvider' => $dataProvider,
        'columns' => array(
            array('name' => 'id', 'header' => '#', 'sortable' => 'true'),
            array('name' => 'listingHeading', 'sortable' => 'true'),
            array('name' => 'price', 'sortable' => 'true'),
            array('name' => 'status', 'sortable' => 'true'),
            array('type' => 'raw', 'header' => 'Total Bids', 'value' => '$data->bidCount'),
            array('type' => 'raw', 'header' => 'View project', 'value' => 'CHtml::link("View Listing",array("listing/view","id"=>$data->id))')
        ),
    ));
    ?>
</div>
<div class="clearfix"></div>

<h1>My Sent Bids</h1>
<div class="span12">
    <?
    $this->widget('zii.widgets.grid.CGridView', array(
        /* 'type'=>'striped bordered condensed', */
        'htmlOptions' => array('class' => 'table'),
        'dataProvider' => $dataProvider2,
        'columns' => array(
             array('type' => 'raw', 'header' => 'Listing Name', 'value' => '$data->list->listingHeading'),
            array('name' => 'amount', 'header' => 'Bid Amount', 'sortable' => 'true'),
            array('name' => 'comment', 'sortable' => 'true'),
            array('name' => 'bidStatus', 'sortable' => 'true'),
            array('type' => 'raw', 'header' => 'View project', 'value' => 'CHtml::link("View Listing",array("listing/view","id"=>$data->list->id))')
        )
    ));
    ?>
</div>