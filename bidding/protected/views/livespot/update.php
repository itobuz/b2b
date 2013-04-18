<?php
$this->breadcrumbs=array(
	'Livespots'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Livespot', 'url'=>array('index')),
	array('label'=>'Create Livespot', 'url'=>array('create')),
	array('label'=>'View Livespot', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Livespot', 'url'=>array('admin')),
);
?>

<h1>Update Livespot <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>