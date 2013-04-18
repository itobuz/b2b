<?php
$this->breadcrumbs=array(
	'Livefutures'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Livefuture', 'url'=>array('index')),
	array('label'=>'Manage Livefuture', 'url'=>array('admin')),
);
?>

<h1>Create Livefuture</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>