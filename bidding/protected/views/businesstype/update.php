<?php
$this->breadcrumbs=array(
	'Businesstypes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Businesstype', 'url'=>array('index')),
	array('label'=>'Create Businesstype', 'url'=>array('create')),
	array('label'=>'View Businesstype', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Businesstype', 'url'=>array('admin')),
);
?>

<h1>Update Businesstype <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>