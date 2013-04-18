<?php
$this->breadcrumbs=array(
	'Listings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Listing', 'url'=>array('index')),
	array('label'=>'Create Listing', 'url'=>array('create')),
	array('label'=>'View Listing', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Listing', 'url'=>array('admin')),
);
?>

<h1>Update Listing <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>