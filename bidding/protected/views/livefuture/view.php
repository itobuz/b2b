<?php
$this->breadcrumbs = array(
    'Livefutures' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Livefuture', 'url' => array('index')),
    array('label' => 'Create Livefuture', 'url' => array('create')),
    array('label' => 'Update Livefuture', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Livefuture', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Livefuture', 'url' => array('admin')),
);
?>

<h1>View Livefuture #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'productName',
        array(
            'name' => 'Show on home?',
            'value' => $model->showOnHome == 0 ? "Yes" : "No",
        ),
        'expiryDate',
        'open',
        'high',
        'low',
        'close',
        'lastTradedPrice',
        'change',
        'changePercentage',
        'AverageTradePrice',
        'spotPrice',
        'bestBuy',
        'bestSell',
        'openInterest',
        'timestamp',
    ),
));
?>
