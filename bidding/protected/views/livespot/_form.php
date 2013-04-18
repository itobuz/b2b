<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'livespot-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'symbol'); ?>
        <?php echo $form->textField($model, 'symbol', array('size' => 60, 'maxlength' => 256)); ?>
        <?php echo $form->error($model, 'symbol'); ?>
    </div>
    <div class="row">
		<?php echo $form->labelEx($model,'showOnHome'); ?>
		<?php echo $form->dropDownList($model, 'showOnHome', array('0'=>'No','1'=>'Yes') , array('empty'=>'--Select--')); ?>
		<?php echo $form->error($model,'showOnHome'); ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model, 'location'); ?>
         <?php 
         echo $form->dropDownList($model, 'location', CHtml::listData(City::model()->findAll(), 'id', 'name')); ?>

    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'timeOfPolling'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'timeOfPolling',
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd'
            ),
        ));
        ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'price'); ?>
        <?php echo $form->textField($model, 'price'); ?>

    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    /*<![CDATA[*/
    jQuery(document).ready(function($){
        if(typeof $('.alert') != 'undefined')
        {
            $('.alert').appendTo('#ferror');
        }
    });
    /*]]>*/
</script>