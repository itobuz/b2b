<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Registration");
$this->breadcrumbs = array(
    UserModule::t("Registration"),
);
$this->layout = '//layouts/column1';
$profileFields = $profile->getFields();
?>


<?php if (Yii::app()->user->hasFlash('registration')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('registration'); ?>
    </div>
<?php else: ?>

    <?php
    $form = $this->beginWidget('UActiveForm', array(
        'id' => 'registration-form',
        'enableAjaxValidation' => true,
        'disableAjaxValidationAttributes' => array('RegistrationForm_verifyCode'),
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    ?>



    <?php echo $form->errorSummary(array($model, $profile)); ?>

    <div class="row half">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email'); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <div class="row half">
        <?php echo $form->labelEx($model, 'email2'); ?>
        <?php echo $form->textField($model, 'email2'); ?>
        <?php echo $form->error($model, 'email2'); ?>
    </div>
    <div class="row half">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password'); ?>

        <?php echo $form->error($model, 'password'); ?>

    </div>

    <div class="row half">
        <?php echo $form->labelEx($model, 'verifyPassword'); ?>
        <?php echo $form->passwordField($model, 'verifyPassword'); ?>
        <?php echo $form->error($model, 'verifyPassword'); ?>
    </div>

    <fieldset class="reg">
        <legend>Enter Your Information-</legend>
        <!--    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username'); ?>	
        <?php echo $form->error($model, 'username'); ?>
            </div>
        
        -->


        <div class="row">
            <?php echo $form->labelEx($profile, $profileFields[0]->varname); ?>
            <span class="wrapme">               
                <?php
                echo $form->radioButtonList($profile, $profileFields[0]->varname, Profile::range($profileFields[0]->range), array('class' => 'hasCustomSelect', 'separator' => '', 'labelOptions' => array('style' => 'display:inline')));
                ?>
            </span>
            <?php echo $form->error($profile, $profileFields[0]->varname); ?>
        </div>
        <div class="row half">
            <?php echo $form->labelEx($profile, $profileFields[2]->varname); ?>

            <?php
            echo $form->textField($profile, $profileFields[2]->varname);
            ?>

            <?php echo $form->error($profile, $profileFields[2]->varname); ?>
        </div>
        <div class="row half">
            <?php echo $form->labelEx($profile, $profileFields[1]->varname); ?>

            <?php
            echo $form->textField($profile, $profileFields[1]->varname);
            ?>

            <?php echo $form->error($profile, $profileFields[1]->varname); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($profile, $profileFields[3]->varname); ?>

            <?php
            echo $form->textField($profile, $profileFields[3]->varname);
            ?>

            <?php echo $form->error($profile, $profileFields[3]->varname); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($profile, $profileFields[4]->varname); ?>

            <?php
            echo $form->textField($profile, $profileFields[4]->varname);
            ?>

            <?php echo $form->error($profile, $profileFields[4]->varname); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($profile, $profileFields[5]->varname); ?>

            <?php
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
            ?>
            <?php
            echo $form->dropDownList($profile, 'state', $state_list, $options);
            echo $form->error($profile, $profileFields[5]->varname);
            ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($profile, $profileFields[6]->varname); ?>

            <?php
            $city_list = array();
            $options = array(
                'tabindex' => '0',
                'empty' => '(not set)',
                'class' => 'customSelect'
            );
            ?>
            <?php echo $form->dropDownList($profile, 'city', $city_list, $options);
            ?>

            <?php echo $form->error($profile, $profileFields[6]->varname); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile, $profileFields[7]->varname); ?>

            <?php
            echo $form->textField($profile, $profileFields[7]->varname);
            ?>

            <?php echo $form->error($profile, $profileFields[7]->varname); ?>
        </div>

        <div class="row half">
            <?php echo $form->labelEx($profile, $profileFields[8]->varname); ?>

            <?php
            echo $form->textField($profile, $profileFields[8]->varname);
            ?>

            <?php echo $form->error($profile, $profileFields[8]->varname); ?>
        </div>

        <div class="row half">
            <?php echo $form->labelEx($profile, $profileFields[9]->varname); ?>

            <?php
            echo $form->textField($profile, $profileFields[9]->varname);
            ?>

            <?php echo $form->error($profile, $profileFields[9]->varname); ?>
        </div>
    </fieldset>

    <fieldset class="reg">
        <legend>Company Information-</legend>

        <div class="row half">
            <?php echo $form->labelEx($profile, $profileFields[10]->varname); ?>

            <?php
            echo $form->textField($profile, $profileFields[10]->varname);
            ?>

            <?php echo $form->error($profile, $profileFields[10]->varname); ?>
        </div>
        <div class="row half">
            <?php echo $form->labelEx($profile, $profileFields[11]->varname); ?>

            <?php
            echo $form->textField($profile, $profileFields[11]->varname);
            ?>

            <?php echo $form->error($profile, $profileFields[11]->varname); ?>
        </div>

        <div class="row half">
            <?php echo $form->labelEx($profile, $profileFields[12]->varname); ?>

            <?php
            echo $form->textField($profile, $profileFields[12]->varname);
            ?>

            <?php echo $form->error($profile, $profileFields[12]->varname); ?>
        </div>
        <div class="row half">
            <?php echo $form->labelEx($profile, $profileFields[13]->varname); ?>

            <?php
            echo $form->textField($profile, $profileFields[13]->varname);
            ?>

            <?php echo $form->error($profile, $profileFields[13]->varname); ?>
        </div>
        <div class="row half">

            <?php
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
            echo $form->labelEx($profile, $profileFields[14]->varname);
            echo $form->dropDownList($profile, 'cstate', $state_list, $options);
            echo $form->error($profile, $profileFields[14]->varname);
            ?>
        </div>
        <div class="row half">
            <?php echo $form->labelEx($profile, $profileFields[15]->varname); ?>

            <?php
            $city_list = array();
            $options = array(
                'tabindex' => '0',
                'empty' => '(not set)',
                'class' => 'customSelect'
            );
            ?>
            <?php echo $form->dropDownList($profile, 'ccity', $city_list, $options);
            ?>

            <?php echo $form->error($profile, $profileFields[15]->varname); ?>
        </div>
        <div class="row half">
            <?php echo $form->labelEx($profile, $profileFields[16]->varname); ?>

            <?php
            echo $form->textField($profile, $profileFields[16]->varname);
            ?>

            <?php echo $form->error($profile, $profileFields[16]->varname); ?>
        </div>
        <div class="row half">
            <?php echo $form->labelEx($profile, $profileFields[17]->varname); ?>

            <?php
            echo $form->textField($profile, $profileFields[17]->varname);
            ?>

            <?php echo $form->error($profile, $profileFields[17]->varname); ?>
        </div>
        <div class="row half">
            <?php echo $form->labelEx($profile, $profileFields[18]->varname); ?>

            <?php
            echo $form->textField($profile, $profileFields[18]->varname);
            ?>

            <?php echo $form->error($profile, $profileFields[18]->varname); ?>
        </div>
        <div class="row half"></div>
        <div class="row">
            <?php echo $form->labelEx($profile, $profileFields[19]->varname); ?>

            <?php
            echo $form->dropDownList($profile, $profileFields[19]->varname, Profile::range($profileFields[19]->range));
            ?>

            <?php echo $form->error($profile, $profileFields[19]->varname); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($profile, "&nbsp;"); ?>

            <?php
            echo $form->textField($profile, $profileFields[20]->varname);
            ?>

            <?php echo $form->error($profile, $profileFields[20]->varname); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($profile, $profileFields[21]->varname); ?>

            <?php
            	
            	$data = Listing::model()->getCommodityOptions();//array('1' => 'Sugar', '2' => 'Aluminium', '3' => 'Jute');
		          //$htmlOptions = array('size' => '5', 'prompt'=>'Use CTRL to Select Multiple Staff', 'multiple' => 'multiple');
		          //echo $form->ListBox($model,'staff_id', $data, $htmlOptions); 
            	echo $form->checkBoxList($comm, 'commId', $data, array('template'=>'{input}{label}', 'separator'=>'',));
            ?>

            <?php echo $form->error($profile, $profileFields[21]->varname); ?>
        </div>
    </fieldset>

    <?php if (UserModule::doCaptcha('registration')): ?>
        <div class="row half captcha">
            <?php echo $form->labelEx($model, '&nbsp;'); ?>

            <?php $this->widget('CCaptcha'); ?>
            <?php echo $form->textField($model, 'verifyCode'); ?>
            <?php echo $form->error($model, 'verifyCode'); ?>
            <br/>
            <p class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
                <?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
        </div>
    <?php endif; ?> 


    <div class="row submit">
        <?php echo CHtml::submitButton(UserModule::t("Register")); ?>
    </div>
    <script src="<?php echo Yii::app()->theme->baseUrl ?>/js/jquery.customSelect.min.js"></script> 
    <script>
        $(document).ready(function(){
            $('select').customSelect();
        });
    </script>
    <?php $this->endWidget();
endif; ?>