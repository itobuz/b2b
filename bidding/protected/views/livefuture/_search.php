<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'productName'); ?>
		<?php echo $form->textField($model,'productName',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'expiryDate'); ?>
		<?php echo $form->textField($model,'expiryDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'open'); ?>
		<?php echo $form->textField($model,'open'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'high'); ?>
		<?php echo $form->textField($model,'high'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'low'); ?>
		<?php echo $form->textField($model,'low'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'close'); ?>
		<?php echo $form->textField($model,'close'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastTradedPrice'); ?>
		<?php echo $form->textField($model,'lastTradedPrice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'change'); ?>
		<?php echo $form->textField($model,'change'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'changePercentage'); ?>
		<?php echo $form->textField($model,'changePercentage'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AverageTradePrice'); ?>
		<?php echo $form->textField($model,'AverageTradePrice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'spotPrice'); ?>
		<?php echo $form->textField($model,'spotPrice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bestBuy'); ?>
		<?php echo $form->textField($model,'bestBuy'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bestSell'); ?>
		<?php echo $form->textField($model,'bestSell'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'openInterest'); ?>
		<?php echo $form->textField($model,'openInterest'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'timestamp'); ?>
		<?php echo $form->textField($model,'timestamp'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->