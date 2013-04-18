<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
        <b><?php echo CHtml::encode($data->getAttributeLabel('showOnHome')); ?>:</b>
	<?php echo CHtml::encode($data->showOnHome == 1 ? 'Yes' : 'No' ); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('symbol')); ?>:</b>
	<?php echo CHtml::encode($data->symbol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
	<?php echo CHtml::encode($data->location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timeOfPolling')); ?>:</b>
	<?php echo CHtml::encode($data->timeOfPolling); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->timestamp); ?>
	<br />


</div>