<?php
$this->breadcrumbs=array(
	'Businesstypes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Businesstype', 'url'=>array('index')),
	array('label'=>'Create Businesstype', 'url'=>array('create')),
	array('label'=>'Update Businesstype', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Businesstype', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Businesstype', 'url'=>array('admin')),
);
?>

<h1>View Businesstype #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
