<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />
    <b><?php echo CHtml::encode($data->getAttributeLabel('showOnHome')); ?>:</b>
    <?php echo CHtml::encode($data->showOnHome == 1 ? 'Yes' : 'No' ); ?>
    <br />
    <b><?php echo CHtml::encode($data->getAttributeLabel('productName')); ?>:</b>
    <?php echo CHtml::encode($data->productName); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('expiryDate')); ?>:</b>
    <?php echo CHtml::encode($data->expiryDate); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('open')); ?>:</b>
    <?php echo CHtml::encode($data->open); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('high')); ?>:</b>
    <?php echo CHtml::encode($data->high); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('low')); ?>:</b>
    <?php echo CHtml::encode($data->low); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('close')); ?>:</b>
    <?php echo CHtml::encode($data->close); ?>
    <br />

    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('lastTradedPrice')); ?>:</b>
      <?php echo CHtml::encode($data->lastTradedPrice); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('change')); ?>:</b>
      <?php echo CHtml::encode($data->change); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('changePercentage')); ?>:</b>
      <?php echo CHtml::encode($data->changePercentage); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('AverageTradePrice')); ?>:</b>
      <?php echo CHtml::encode($data->AverageTradePrice); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('spotPrice')); ?>:</b>
      <?php echo CHtml::encode($data->spotPrice); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('bestBuy')); ?>:</b>
      <?php echo CHtml::encode($data->bestBuy); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('bestSell')); ?>:</b>
      <?php echo CHtml::encode($data->bestSell); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('openInterest')); ?>:</b>
      <?php echo CHtml::encode($data->openInterest); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('timestamp')); ?>:</b>
      <?php echo CHtml::encode($data->timestamp); ?>
      <br />

     */ ?>

</div>