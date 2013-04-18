<?php
$this->breadcrumbs=array(
	'Bids'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Bid', 'url'=>array('index')),
	array('label'=>'Create Bid', 'url'=>array('create')),
	array('label'=>'Update Bid', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Bid', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bid', 'url'=>array('admin')),
);
?>

<h1>View Bid #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'listId',
		'userId',
		'amount',
		'comment',
		'bidStatus',
	),
)); ?>
