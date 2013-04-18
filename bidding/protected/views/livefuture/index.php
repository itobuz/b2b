<?php
$this->breadcrumbs=array(
	'Livefutures',
);

$this->menu=array(
	array('label'=>'Create Livefuture', 'url'=>array('create')),
	array('label'=>'Manage Livefuture', 'url'=>array('admin')),
);
?>

<h1>Livefutures</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
