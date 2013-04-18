<?php
$this->breadcrumbs=array(
	'Businesstypes',
);

$this->menu=array(
	array('label'=>'Create Businesstype', 'url'=>array('create')),
	array('label'=>'Manage Businesstype', 'url'=>array('admin')),
);
?>

<h1>Businesstypes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
