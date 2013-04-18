<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'livefuture-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'productName'); ?>
		<?php echo $form->textField($model,'productName',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'productName'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'showOnHome'); ?>
		<?php echo $form->dropDownList($model, 'showOnHome', array('0'=>'No','1'=>'Yes') , array('empty'=>'--Select--')); ?>
		<?php echo $form->error($model,'showOnHome'); ?>
	</div>
        
        
	<div class="row">
		<?php echo $form->labelEx($model,'expiryDate'); ?>
		<?php echo $form->textField($model,'expiryDate'); ?>
		<?php echo $form->error($model,'expiryDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'open'); ?>
		<?php echo $form->textField($model,'open'); ?>
		<?php echo $form->error($model,'open'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'high'); ?>
		<?php echo $form->textField($model,'high'); ?>
		<?php echo $form->error($model,'high'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'low'); ?>
		<?php echo $form->textField($model,'low'); ?>
		<?php echo $form->error($model,'low'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'close'); ?>
		<?php echo $form->textField($model,'close'); ?>
		<?php echo $form->error($model,'close'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastTradedPrice'); ?>
		<?php echo $form->textField($model,'lastTradedPrice'); ?>
		<?php echo $form->error($model,'lastTradedPrice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'change'); ?>
		<?php echo $form->textField($model,'change'); ?>
		<?php echo $form->error($model,'change'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'changePercentage'); ?>
		<?php echo $form->textField($model,'changePercentage'); ?>
		<?php echo $form->error($model,'changePercentage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AverageTradePrice'); ?>
		<?php echo $form->textField($model,'AverageTradePrice'); ?>
		<?php echo $form->error($model,'AverageTradePrice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'spotPrice'); ?>
		<?php echo $form->textField($model,'spotPrice'); ?>
		<?php echo $form->error($model,'spotPrice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bestBuy'); ?>
		<?php echo $form->textField($model,'bestBuy'); ?>
		<?php echo $form->error($model,'bestBuy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bestSell'); ?>
		<?php echo $form->textField($model,'bestSell'); ?>
		<?php echo $form->error($model,'bestSell'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'openInterest'); ?>
		<?php echo $form->textField($model,'openInterest'); ?>
		<?php echo $form->error($model,'openInterest'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'timestamp'); ?>
		<?php echo $form->textField($model,'timestamp'); ?>
		<?php echo $form->error($model,'timestamp'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->