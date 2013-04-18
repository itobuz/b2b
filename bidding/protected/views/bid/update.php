<?php
$this->breadcrumbs=array(
	'Bids'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bid', 'url'=>array('index')),
	array('label'=>'Create Bid', 'url'=>array('create')),
	array('label'=>'View Bid', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Bid', 'url'=>array('admin')),
);
?>

<h1>Update Bid <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>