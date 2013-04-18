<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'orderType'); ?>
		<?php echo $form->textField($model,'orderType',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'commodityName'); ?>
		<?php echo $form->textField($model,'commodityName',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'productType'); ?>
		<?php echo $form->textField($model,'productType',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'orderQty'); ?>
		<?php echo $form->textField($model,'orderQty'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deliveryDate'); ?>
		<?php echo $form->textField($model,'deliveryDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paymentDate'); ?>
		<?php echo $form->textField($model,'paymentDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'state'); ?>
		<?php echo $form->textField($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city'); ?>
		<?php echo $form->textField($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kms'); ?>
		<?php echo $form->textField($model,'kms'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paymentTerms'); ?>
		<?php echo $form->textField($model,'paymentTerms',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'expireTime'); ?>
		<?php echo $form->textField($model,'expireTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tradeType'); ?>
		<?php echo $form->textField($model,'tradeType',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'specialRequirments'); ?>
		<?php echo $form->textArea($model,'specialRequirments',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'commodityTestReport'); ?>
		<?php echo $form->textField($model,'commodityTestReport',array('size'=>60,'maxlength'=>512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deliveryAddress'); ?>
		<?php echo $form->textArea($model,'deliveryAddress',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lat'); ?>
		<?php echo $form->textField($model,'lat',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'long'); ?>
		<?php echo $form->textField($model,'long',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->