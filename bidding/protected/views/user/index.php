<?php
$this->breadcrumbs = array(
    'Users',
);

$this->menu = array(
    array('label' => 'Create User', 'url' => array('create')),
    array('label' => 'Manage User', 'url' => array('admin')),
);
?>

<h1>Registered Users</h1>
<?
$this->widget('zii.widgets.grid.CGridView', array(
    /* 'type'=>'striped bordered condensed', */
    'htmlOptions' => array('class' => 'table'),
    'dataProvider' => $dataProvider,
    'columns' => array(
        array('name' => 'username', 'sortable' => true, 'header' => 'Username'),
        array('name' => 'email', 'sortable' => true, 'header' => 'Email Address'),
        array('name' => 'companyName', 'sortable' => true, 'header' => 'Company Name'),
        array('name' => 'ownerName', 'sortable' => true, 'header' => 'Owner Name'),
        array('name' => 'tradeCapacity', 'sortable' => true, 'header' => 'Trade Capacity'),
        array('name' => 'rstCst', 'sortable' => true, 'header' => 'Rst / Cst'),
        array('type' => 'raw', 'sortable' => true, 'header' => 'View', 'value' => 'CHtml::link("View User",array("users/".$data->username))'),
    ),
));
?>
