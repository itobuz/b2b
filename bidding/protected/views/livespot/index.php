<?php
$this->breadcrumbs=array(
	'Livespots',
);

$this->menu=array(
	array('label'=>'Create Livespot', 'url'=>array('create')),
	array('label'=>'Manage Livespot', 'url'=>array('admin')),
);
?>

<h1>Livespots</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
