<?php
$this->breadcrumbs=array(
	'Livefutures'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Livefuture', 'url'=>array('index')),
	array('label'=>'Create Livefuture', 'url'=>array('create')),
	array('label'=>'View Livefuture', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Livefuture', 'url'=>array('admin')),
);
?>

<h1>Update Livefuture <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>