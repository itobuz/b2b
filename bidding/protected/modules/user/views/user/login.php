<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Login");
$this->layout = "//layouts/column1_signin";
?>
<div id="signdiv">
    <div id="signin">
        <h2>Sign In</h2>
        <?php echo CHtml::beginForm(); ?>
        <div class="row">
            <label for="UserLogin_username">Username :</label>
            <?php echo CHtml::activeTextField($model, 'username') ?>
        </div>
        <div class="row">
            <label for="UserLogin_password">Password :</label>
            <?php echo CHtml::activePasswordField($model, 'password') ?>
        </div>


        <div class="row rememberMe">
            <div class="gap"></div>	
            <label for="UserLogin_rememberMe">Remember Me</label>
            <?php echo CHtml::activeCheckBox($model, 'rememberMe'); ?>
        </div>
        <div class="row nomargin">
            <div class="gap"></div>
            Forgot your password? <a href="<?php Yii::app()->createUrl('/user/recovery') ?>">Click here</a>
        </div>
        <div class="row nomargin">
            <div class="gap"></div>
            Verification mail not found? Click here
        </div>
        <div class="row submit">
            <div class="gap"></div>	
            <?php echo CHtml::submitButton(UserModule::t("Login"), array('class' => 'sbutton')); ?>
        </div>
        <?php echo CHtml::endForm(); ?>
    </div> 
    <div id="register">
        <h2>Join Us</h2>

        <div id="words">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
Maecenas leo elit, iaculis vel tristique viverra, aliquam sed tellus. Aliquam vel odio elit, sed consequat elit. Cras purus nulla, sodales sit amet suscipit et, lacinia sed eros. Donec vitae 
tincidunt lorem. Donec volutpat, justo a ornare mattis, nisi lectus condimentum sapien, sed porttitor dolor erat eget justo. Morbi mattis nunc vel justo ornare accumsan. 
        </div>
<div id="words"><center>
             <?php echo CHtml::button('Register', array('class' => 'sbutton' , 'onClick' => 'document.location.href="'.Yii::app()->createUrl('/user/registration').'"')); ?>
        </center></div>
    </div>
    <div class="clear"></div>
</div>

