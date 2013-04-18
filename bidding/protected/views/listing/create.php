<?php
$this->breadcrumbs=array(
	'Listings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Listing', 'url'=>array('index')),
	array('label'=>'Manage Listing', 'url'=>array('admin') , 'visible' => Yii::app()->user->checkAccess('Admin')),
);
?>

<h1>Create Listing</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>