<div id="ferror"></div>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php
    $errors = $form->errorSummary($model);
    if (!empty($errors))
        Yii::app()->user->setFlash('error', $errors);
    ?>

    <div class="row fl">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('size' => 30, 'maxlength' => 30 ,'readonly'=>true)); ?>

    </div>

    <div class="row fl">
        <?php echo $form->labelEx($model, 'address1'); ?>
        <?php echo $form->textField($model, 'address1', array('size' => 60, 'maxlength' => 256)); ?>

    </div>

    <div class="row fl">
        <?php echo $form->labelEx($model, 'address2'); ?>
        <?php echo $form->textField($model, 'address2', array('size' => 60, 'maxlength' => 256)); ?>

    </div>
    <div class="row fl">
        <?php echo $form->labelEx($model, 'state'); ?>
        <?
        $state_list = CHtml::listData(State::model()->findAll(), 'id', 'name');

        $options = array(
            'tabindex' => '0',
            'empty' => array('(not set)'),
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createurl('LoadCities'),
                'data' => array('sId' => 'js: $("#User_state option:selected").val()'),
                'update' => '#User_city',
            )
        );
        ?>
        <?php echo $form->dropDownList($model, 'state', $state_list, $options); ?>


        <?php echo $form->error($model, 'state'); ?>
    </div>

    <div class="row fl">
        <?php echo $form->labelEx($model, 'city'); ?>
        <?
        $city_list = array();
        $options = array(
            'tabindex' => '0',
            'empty' => '(not set)',
        );
        ?>
        <?php echo $form->dropDownList($model, 'city', $city_list, $options); ?>
    </div>


    <div class="row fl">
        <?php echo $form->labelEx($model, 'pincode'); ?>
        <?php echo $form->textField($model, 'pincode'); ?>

    </div>

    <div class="row fl">
        <?php echo $form->labelEx($model, 'cellphone'); ?>
        <?php echo $form->textField($model, 'cellphone', array('size' => 10, 'maxlength' => 10)); ?>

    </div>

    <div class="row fl">
        <?php echo $form->labelEx($model, 'landline'); ?>
        <?php echo $form->textField($model, 'landline', array('size' => 15, 'maxlength' => 15)); ?>

    </div>
    <?
    if (Yii::app()->user->checkAccess('admin')) {
        ?>
        <div class="row fl">
            <?php echo $form->labelEx($model, 'level'); ?>
            <?php
            $list = array(2 => 'Admin', 0 => 'Registered');

            echo CHtml::dropDownList('User_level', $model->level, $list, array('empty' => '(Select Level)'));
            ?>
            <?php echo $form->error($model, 'level'); ?>
        </div>
    <? } ?>
    <div class="row fl">
        <?php echo $form->labelEx($model, 'fax'); ?>
        <?php echo $form->textField($model, 'fax', array('size' => 15, 'maxlength' => 15)); ?>

    </div>

    <div class="row fl">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 512 , 'readonly'=>true)); ?>

    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'panId'); ?>
        <?php echo $form->textField($model, 'panId', array('size' => 10, 'maxlength' => 10)); ?>

    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'companyName'); ?>
        <?php echo $form->textField($model, 'companyName', array('size' => 60, 'maxlength' => 512)); ?>

    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'companyForm'); ?>
        <?php echo $form->textField($model, 'companyForm', array('size' => 60, 'maxlength' => 512)); ?>

    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'yearEstablished'); ?>
        <?php echo $form->textField($model, 'yearEstablished'); ?>

    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'registrationNumber'); ?>
        <?php echo $form->textField($model, 'registrationNumber', array('size' => 60, 'maxlength' => 128)); ?>

    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'issuingAuthority'); ?>
        <?php echo $form->textField($model, 'issuingAuthority', array('size' => 60, 'maxlength' => 256)); ?>

    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'ownerName'); ?>
        <?php echo $form->textField($model, 'ownerName', array('size' => 60, 'maxlength' => 256)); ?>

    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'userType'); ?>
        <?php
        $list = array('buyer', 'seller');

        echo CHtml::dropDownList('User_userType', $model->userType, $list, array('empty' => '(Select Type)'));
        ?>
        <?php echo $form->error($model, 'userType'); ?>
    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'rstCst'); ?>
        <?php echo $form->textField($model, 'rstCst', array('size' => 60, 'maxlength' => 256)); ?>

    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'beatAccountNumber'); ?>
        <?php echo $form->textField($model, 'beatAccountNumber', array('size' => 60, 'maxlength' => 512)); ?>

    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'businessType'); ?>

        <?
        $businessTypes = CHtml::listData(Businesstype::model()->findAll(), 'id', 'name');

        $options = array(
            'tabindex' => '0',
            'empty' => array('(not set)')
        );
        ?>
        <?php echo $form->dropDownList($model, 'businessType', $businessTypes, $options); ?>
        <?php echo $form->error($model, 'businessType'); ?>
    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'tradeCapacity'); ?>
        <?php echo $form->textField($model, 'tradeCapacity', array('size' => 60, 'maxlength' => 100)); ?>

    </div>
    
    <div class="row fl">
        <?php echo $form->labelEx($model, 'changePass'); ?>
        <?php echo CHtml::checkBox('changePass'); ?>
    </div>
     <div class="cb"></div>
      <div class="row fl">
        <?php echo $form->labelEx($model, 'oldPass'); ?>
        <?php echo $form->passwordField($model, 'oldPass', array('size' => 35, 'maxlength' => 35 , 'disabled' => true)); ?>

    </div>
    <div class="cb"></div>
    <div class="row fl">
        <?php echo $form->labelEx($model, 'newPass'); ?>
        <?php echo $form->passwordField($model, 'newPass', array('size' => 35, 'maxlength' => 35 , 'disabled' => true)); ?>

    </div>
     <div class="cb"></div>
    <div class="row fl">
        <?php echo $form->labelEx($model, 'newPass2'); ?>
        <?php echo $form->passwordField($model, 'newPass2', array('size' => 35, 'maxlength' => 35 , 'disabled' => true)); ?>

    </div>
    <div class="cb"></div>
    <div class="row buttons">
      
       
            <?php echo CHtml::submitButton('Update'); ?>
      
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
        var hasValue = $('#User_state').has('[selected]');
        if(hasValue)
        {
            jQuery.ajax({'type':'POST','url':'<?php echo Yii::app()->createUrl('/user/LoadCities'); ?>','data':{'sId': $("#User_state option:selected").val()},'cache':false,'success':function(html){jQuery("#User_city").html(html)}})
        }
    
	
	$('#changePass').click(function(){
   $('#User_oldPass,#User_newPass , #User_newPass2').attr('disabled',!this.checked);
   if(this.checked)
   	 $('#User_oldPass,#User_newPass , #User_newPass2').val('');	
});

    });
    /*]]>*/
   
</script>
