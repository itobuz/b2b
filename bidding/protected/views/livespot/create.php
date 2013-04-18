<?php
$this->breadcrumbs=array(
	'Livespots'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Livespot', 'url'=>array('index')),
	array('label'=>'Manage Livespot', 'url'=>array('admin')),
);
?>

<h1>Create Livespot</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>