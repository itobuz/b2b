<?php

Yii::import('application.controllers.ListingController');
$this->widget('zii.widgets.grid.CGridView', array(
    /* 'type'=>'striped bordered condensed', */
    'htmlOptions' => array('class' => 'table'),
    'dataProvider' => $listingDataProvider,
    'id'=>'tabs',
    'enablePagination'=>true,
    'columns' => array(
        array('name' => 'id', 'header' => '#', 'sortable' => 'true',),
        array('name' => 'listingHeading', 'header' => 'Title', 'sortable' => 'true',),
        array('name' => 'productType', 'header' => 'Commodity Type', 'sortable' => 'true',),
        array('name' => 'commodityName', 'header' => 'Commodity Name', 'sortable' => 'true',),
        array('type' => 'raw', 'header' => 'Location', 'value' => 'ucfirst(City::model()->getNameById($data->city)).", ".ucfirst(State::model()->getNameById($data->state))'),
        array('type' => 'raw',
            'value' => 'CHtml::link("View Listing",array("listing/view",
                                         "id"=>$data->id))',
            'header' => 'view'),
    ),
));
?>
<span style="float:right;">
<a href="<? echo Yii::app()->createUrl('/listing/category/'.$type)?>" >Read more</a>
    </span><br>
<span style="clear:both"></span>