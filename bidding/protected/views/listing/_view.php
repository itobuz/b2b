<div class="view">
  

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('orderType')); ?>:</b>
    <?php echo CHtml::encode($data->orderType); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('commodityName')); ?>:</b>
    <?php echo CHtml::encode($data->commodityName); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('productType')); ?>:</b>
    <?php echo CHtml::encode($data->productType); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('orderQty')); ?>:</b>
    <?php echo CHtml::encode($data->orderQty); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('deliveryDate')); ?>:</b>
    <?php echo CHtml::encode($data->deliveryDate); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('paymentDate')); ?>:</b>
    <?php echo CHtml::encode($data->paymentDate); ?>
    <br />


</div>