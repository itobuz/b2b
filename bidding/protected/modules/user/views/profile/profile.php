<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Profile");
$this->breadcrumbs = array(
    UserModule::t("Profile"),
);
$this->menu = array(
    ((UserModule::isAdmin()) ? array('label' => UserModule::t('Manage Users'), 'url' => array('/user/admin')) : array()),
    array('label' => UserModule::t('List User'), 'url' => array('/user')),
    array('label' => UserModule::t('Edit'), 'url' => array('edit')),
    array('label' => UserModule::t('Change password'), 'url' => array('changepassword')),
    array('label' => UserModule::t('Logout'), 'url' => array('/user/logout')),
);
?><h1><?php echo UserModule::t('Your profile'); ?></h1>



<?php if (Yii::app()->user->hasFlash('profileMessage')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('profileMessage'); ?>
    </div>
<?php endif; ?>
<!--
<table class="dataGrid">
    
    <?php
    $profileFields = ProfileField::model()->forOwner()->sort()->findAll();
    if ($profileFields) {
        ?>
        <tr>
            <th class="label"><?php echo CHtml::encode(UserModule::t($profileFields[1]->title)); ?></th>
            <td><?php echo CHtml::encode($profile->getAttribute($profileFields[1]->varname)); ?></td>
        </tr>
        <tr>
            <th class="label"><?php echo CHtml::encode(UserModule::t($profileFields[0]->title)); ?></th>
            <td><?php echo CHtml::encode($profile->getAttribute($profileFields[0]->varname)); ?></td>
        </tr>
        <tr>
            <th class="label"><?php echo CHtml::encode(UserModule::t($profileFields[2]->title)); ?></th>
            <td><?php echo CHtml::encode($profile->getAttribute($profileFields[2]->varname)); ?></td>
        </tr>
        <tr>
            <th class="label"><?php echo CHtml::encode(UserModule::t($profileFields[3]->title)); ?></th>
            <td><?php echo CHtml::encode($profile->getAttribute($profileFields[3]->varname)); ?></td>
        </tr>
        <tr>
            <th class="label"><?php echo CHtml::encode(UserModule::t($profileFields[4]->title)); ?></th>
            <td><?php
    $state_obj = State::model()->findByAttributes(array('id' => $profile->getAttribute($profileFields[4]->varname)));
    if (!empty($state_obj)) {
        echo CHtml::encode($state_obj->name);
    }
    ?></td>
        </tr>
        <tr>
            <th class="label"><?php echo CHtml::encode(UserModule::t($profileFields[5]->title)); ?></th>
            <td><?php echo CHtml::encode($profile->getAttribute($profileFields[5]->varname)); ?></td>
        </tr>
        
        <tr>
            <th class="label"><?php echo CHtml::encode(UserModule::t($profileFields[6]->title)); ?></th>
            <td><?php echo CHtml::encode($profile->getAttribute($profileFields[6]->varname)); ?></td>
        </tr>
        <tr>
            <th class="label"><?php echo CHtml::encode(UserModule::t($profileFields[7]->title)); ?></th>
            <td><?php echo CHtml::encode($profile->getAttribute($profileFields[7]->varname)); ?></td>
        </tr>
        <tr>
            <th class="label"><?php echo CHtml::encode(UserModule::t($profileFields[8]->title)); ?></th>
            <td><?php echo CHtml::encode($profile->getAttribute($profileFields[8]->varname)); ?></td>
        </tr>  
    <?php
}
?>
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
        <td><?php echo CHtml::encode($model->email); ?></td>
    </tr>
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></th>
        <td><?php echo $model->create_at; ?></td>
    </tr>
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></th>
        <td><?php echo $model->lastvisit_at; ?></td>
    </tr>
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
        <td><?php echo CHtml::encode(User::itemAlias("UserStatus", $model->status)); ?></td>
    </tr>
</table>-->


<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
				if($field->varname != 'comment'){
				?> <div class="row">
				<label><?php echo CHtml::encode($profile->getAttributeLabel($field->varname)); ?></label>
				<?php		
						
					if ($field->range){
?>
					<span class="viewrow">
					<?php 
					
					
					
					
						$arr = Profile::range($field->range);
						echo $arr[$profile->getAttribute($field->varname)];
					
					?></span>
		
<?php	
						
					}else{
						if($field->varname == 'state' || $field->varname == 'cstate'){
							$state_list = CHtml::listData(State::model()->findAll(), 'id', 'name');
							echo '<span class="viewrow">'.$state_list[$profile->getAttribute($field->varname)].'</span>';
						}elseif($field->varname == 'city' || $field->varname == 'ccity'){
							$city_list = CHtml::listData(City::model()->findAll(), 'id', 'name');
							echo '<span class="viewrow">'.$city_list[$profile->getAttribute($field->varname)].'</span>';
						}else{
						
			?>
				
					<span class="viewrow"><?php echo CHtml::encode($profile->getAttribute($field->varname)); ?></span>
			
				
	
			<?php }
			} ?> </div>	<?php }}
		}
?>
<div class="row">
	<label>Interested Commodities</label>
	<?php
		$commo = Interestedcomm::model()->findAllByAttributes(array('userId'=>Yii::app()->user->id));
		$data = Listing::model()->getCommodityOptions();
		foreach($commo as $c){
			
			echo '<span class="viewrow">',$data[$c->commId],'</span> ';
		}
?>
	
</div>


