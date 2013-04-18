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

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
