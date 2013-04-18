<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->username=>array('/users/'.$model->username),
	'Edit',
);
?>

<h1>Edit Profile</h1>

<?php echo $this->renderPartial('_form_edit', array('model'=>$model)); ?>