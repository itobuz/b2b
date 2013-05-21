<?php
$this->breadcrumbs=array(
	'Listings',
);

$this->menu=array(
	array('label'=>'Create Listing', 'url'=>array('create')),
	array('label'=>'Manage Listing', 'url'=>array('admin') , 'visible' => Yii::app()->user->checkAccess('Admin')),
);
?>

<h1>Listings</h1>

    <?php
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
            array('name' => 'expireTime', 'sortable' => 'true', 'header' => 'Expiry Date'),
           
            array('name' => 'status', 'sortable' => 'true'),
            array('type' => 'raw', 'sortable' => 'true', 'header' => 'Delivery within(Kms)', 'value' => 'empty($data->kms) || $data->kms == 0 ? "Not specified" : $data->kms'),
            array('type' => 'raw', 'header' => 'Edit', 'sortable' => 'true', 'value' => 'CHtml::link("View Listing",array("listing/view","id"=>$data->id))'),
        ),
    ));
    ?>
