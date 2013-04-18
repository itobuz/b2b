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

    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
      <?php echo CHtml::encode($data->price); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
      <?php echo CHtml::encode($data->state); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
      <?php echo CHtml::encode($data->city); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('kms')); ?>:</b>
      <?php echo CHtml::encode($data->kms); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('paymentTerms')); ?>:</b>
      <?php echo CHtml::encode($data->paymentTerms); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('expireTime')); ?>:</b>
      <?php echo CHtml::encode($data->expireTime); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('tradeType')); ?>:</b>
      <?php echo CHtml::encode($data->tradeType); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('specialRequirments')); ?>:</b>
      <?php echo CHtml::encode($data->specialRequirments); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('commodityTestReport')); ?>:</b>
      <?php echo CHtml::encode($data->commodityTestReport); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('deliveryAddress')); ?>:</b>
      <?php echo CHtml::encode($data->deliveryAddress); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('lat')); ?>:</b>
      <?php echo CHtml::encode($data->lat); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('long')); ?>:</b>
      <?php echo CHtml::encode($data->long); ?>
      <br />

     */ ?>

</div>