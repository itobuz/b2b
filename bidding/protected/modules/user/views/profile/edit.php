<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile")=>array('profile'),
	UserModule::t("Edit"),
);
$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
		:array()),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Profile'), 'url'=>array('/user/profile')),
    array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
);
?><h1><?php echo UserModule::t('Edit profile'); ?></h1>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
				if($field->varname != 'comment'){
			?>
	<div class="row">
		<?php echo $form->labelEx($profile,$field->varname);
		
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			if($field->varname == 'state'){
				$state_list = CHtml::listData(State::model()->findAll(), 'id', 'name');
	            $options = array(
	                'tabindex' => '0',
	                'empty' => array('(not set)'),
	                'ajax' => array(
	                    'type' => 'POST',
	                    'url' => array('/site/loadcities'),
	                    'data' => array('sId' => 'js: $("#Profile_state option:selected").val()'),
	                    'update' => '#Profile_city',
	                )
	            );
				echo $form->dropDownList($profile, $field->varname, $state_list, $options);
			}
			elseif($field->varname == 'cstate'){
				$state_list = CHtml::listData(State::model()->findAll(), 'id', 'name');
	            $options = array(
	                'tabindex' => '0',
	                'empty' => array('(not set)'),
	                'ajax' => array(
	                    'type' => 'POST',
	                    'url' => array('/site/loadcities'),
	                    'data' => array('sId' => 'js: $("#Profile_cstate option:selected").val()'),
	                    'update' => '#Profile_ccity',
	                )
	            );
				echo $form->dropDownList($profile, $field->varname, $state_list, $options);
			}
			elseif($field->varname == 'city'){
				$city_list = CHtml::listData(City::model()->findAll(), 'id', 'name');
	            $options = array(
	                'tabindex' => '0',
	                'empty' => '(not set)',
	                'class' => 'customSelect'
	            );
				echo $form->dropDownList($profile, $field->varname, $city_list, $options);
			}
			elseif($field->varname == 'ccity'){
				$city_list = CHtml::listData(City::model()->findAll(), 'id', 'name');
	            $options = array(
	                'tabindex' => '0',
	                'empty' => '(not set)',
	                'class' => 'customSelect'
	            );
				echo $form->dropDownList($profile, $field->varname, $city_list, $options);
			}
			else
				echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		echo $form->error($profile,$field->varname); ?>
	</div>	
			<?php
			}}
		}
?>

	        <div class="row">
            <?php echo $form->labelEx($comm, 'commId',array('label' => 'Interested Commodities')); ?>

            <?php
            	
            	$data = Listing::model()->getCommodityOptions();//array('1' => 'Sugar', '2' => 'Aluminium', '3' => 'Jute');

            	echo $form->checkBoxList($comm, 'commId', $data, array('template'=>'{input}{label}', 'separator'=>'','class'=>'commodity'));
				 // }
				$commo = Interestedcomm::model()->findAllByAttributes(array('userId'=>Yii::app()->user->id));
				//echo $commo->commId;
				?>
				<script>
					var comms = ''; 
				</script>
				
				<?php
				foreach($commo as $c){
					//echo "<br/>";
					//print_r($c->commId);
				?>
				<script>
					if(comms.length == 0)
						comms += 'Interestedcomm_commId_'+<?php echo $c->commId; ?>;
					else
						comms += ':Interestedcomm_commId_'+<?php echo $c->commId; ?>;
				</script>
				
				<?php
				}
				
		    ?>
		    <script>
		    	jQuery(function($) {
		    		var myArray = comms.split(':');

				   
				    for(var i=0;i<myArray.length;i++){
				        $("#"+myArray[i]).attr('checked', true);
				        console.log(myArray[i]);
				    }
			    	
			    	
		    	});
		    </script>

            <?php //echo $form->error($profile, $profileFields[21]->varname); ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
