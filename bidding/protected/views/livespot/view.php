<?php
$this->breadcrumbs = array(
    'Livespots' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Livespot', 'url' => array('index')),
    array('label' => 'Create Livespot', 'url' => array('create')),
    array('label' => 'Update Livespot', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Livespot', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Livespot', 'url' => array('admin')),
);
?>

<h1>View Livespot #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'symbol',
        array(
        'name'=>'Show on home?',
        'value'=>$model->showOnHome == 0 ? "Yes" : "No",
    ),
        'location',
        'timeOfPolling',
        'price',
        'timestamp',
    ),
));
?>
