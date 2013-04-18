<?php
$this->breadcrumbs=array(
	'Businesstypes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Businesstype', 'url'=>array('index')),
	array('label'=>'Manage Businesstype', 'url'=>array('admin')),
);
?>

<h1>Create Businesstype</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>