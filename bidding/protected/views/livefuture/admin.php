<?php
$this->breadcrumbs = array(
    'Livefutures' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Livefuture', 'url' => array('index')),
    array('label' => 'Create Livefuture', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('livefuture-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Livefutures</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'livefuture-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'productName',
        'expiryDate',
        'open',
        'high',
        'low',
        /*
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
         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete} {hideOnHome} {showOnHome}',
            'buttons' => array
                (
                'showOnHome' => array
                    (
                    'label' => "Hide this record from Home",
                    'imageUrl' => Yii::app()->request->baseUrl . "/images/home_active.png",
                    'url' => 'Yii::app()->createUrl("livefuture/showonhome", array("id"=>$data->id ,  "action" => "hide"))',
                    'visible' => '$data->showOnHome == 1'
                ),
                'hideOnHome' => array
                    (
                    'label' => "Show this record on Home",
                    'imageUrl' => Yii::app()->request->baseUrl . "/images/home_grey.png",
                    'url' => 'Yii::app()->createUrl("livefuture/showonhome", array("id"=>$data->id ,  "action" => "show"))',
                    'visible' => '$data->showOnHome == 0'
                ),
            ),
        )
    ),
));
?>


