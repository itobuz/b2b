<?php
$this->breadcrumbs=array(
	'Bids'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Bid', 'url'=>array('index')),
	array('label'=>'Manage Bid', 'url'=>array('admin')),
);
?>

<h1>Create Bid</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>