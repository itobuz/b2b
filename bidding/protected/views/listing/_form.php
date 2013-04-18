<div id="ferror"></div>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'listing-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php
    $errors = $form->errorSummary($model);
    if (!empty($errors))
        Yii::app()->user->setFlash('error', $errors);
    ?>
    <div class="row fl">
        <?php echo $form->labelEx($model, 'listingHeading'); ?>
        <?php echo $form->textField($model, 'listingHeading'); ?>
    </div>

    <div class="row fl">
        <?php echo $form->labelEx($model, 'orderType'); ?>
        <?php echo ZHtml::enumDropDownList($model, 'orderType'); ?>
    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'commodityName'); ?>
        <?php echo ZHtml::enumDropDownList($model, 'commodityName'); ?>

    </div>

    <div class="row fl">
        <?php echo $form->labelEx($model, 'productType'); ?>
        <?php echo ZHtml::enumDropDownList($model, 'productType'); ?>
    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'orderQty'); ?>
        <?php echo $form->textField($model, 'orderQty'); ?>
    </div>

    <div class="row fl">
        <?php echo $form->labelEx($model, 'deliveryDate'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'deliveryDate',
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd'
            ),
        ));
        ?>
    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'paymentDate'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'paymentDate',
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd'
            ),
        ));
        ?>
    </div>

    <div class="row fl">
        <?php echo $form->labelEx($model, 'price'); ?>
        <?php echo $form->textField($model, 'price'); ?>
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
                'url' => array('site/loadcities'),
                'data' => array('sId' => 'js: $("#Listing_state option:selected").val()'),
                'update' => '#Listing_city',
            )
        );
        ?>
        <?php echo $form->dropDownList($model, 'state', $state_list, $options); ?>
    </div>

    <div class="row fr">
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

    <div class="row fr">
        <?php echo $form->labelEx($model, 'kms'); ?>
        <?php echo $form->textField($model, 'kms'); ?>
    </div>

    <div class="row fl">
        <?php echo $form->labelEx($model, 'paymentTerms'); ?>
        <?php echo ZHtml::enumDropDownList($model, 'paymentTerms'); ?>
    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'expireTime'); ?>

        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'expireTime',
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd'
            ),
        ));
        ?>

    </div>

    <div class="row fl">
        <?php echo $form->labelEx($model, 'tradeType'); ?>
        <?php echo ZHtml::enumDropDownList($model, 'tradeType'); ?>
    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'specialRequirments'); ?>
        <?php echo $form->textArea($model, 'specialRequirments', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row fl">
        <?php echo $form->labelEx($model, 'commodityTestReport'); ?>
        <?php
     
        $this->widget('CMultiFileUpload', array(
            'model'=>$model,
            'attribute' => 'commodityTestReport',
            'accept' => 'jpeg|jpg|gif|png|pdf|rtf|doc|docx|xls|xlsx|csv|txt', // useful for verifying files
            'duplicate' => 'Duplicate file!', // useful, i think
            'denied' => 'Invalid file type', // useful, i think
        ));
        ?>
    </div>

    <div class="row fr">
        <?php echo $form->labelEx($model, 'deliveryAddress'); ?>
        <?php echo $form->textArea($model, 'deliveryAddress', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row fl" style="position:relative">
        <?php echo $form->labelEx($model, 'lat'); ?>
        <?php echo $form->textField($model, 'lat', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->labelEx($model, 'long'); ?>
        <?php echo $form->textField($model, 'long', array('size' => 50, 'maxlength' => 50)); ?>

        <span id="mapbutton">

            <?
            $this->widget('ext.CoordinatePicker.CoordinatePicker', array(
                'model' => $model,
                'latitudeAttribute' => 'lat',
                'longitudeAttribute' => 'long',
                //optional settings
                'editZoom' => 12,
                'pickZoom' => 7,
                'defaultLatitude' => 28.65247775374311,
                'defaultLongitude' => 77.09501731796877,
            ));
            ?>

        </span>
    </div>
    <? if( Yii::app()->user->checkAccess('admin')){ ?>
      <div class="row fl">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo ZHtml::enumDropDownList($model, 'status'); ?>
          <br>
          <br>
    </div>
    <? } ?>
    <div class="row buttons fr">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
    <div class="cb"></div>
    
    <?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    /*<![CDATA[*/
    jQuery(document).ready(function($){
        if(typeof $('.alert') != 'undefined')
        {
            $('.alert').appendTo('#ferror');
        }
        var hasValue = $('#Listing_state').has('[selected]');
        if(hasValue)
        {
            jQuery.ajax({'type':'POST','url':' <?php echo Yii::app()->createUrl('/site/LoadCities'); ?>','data':{'sId': $("#Listing_state option:selected").val()},'cache':false,'success':function(html){jQuery("#Listing_city").html(html)}})
        }
    
    });
    /*]]>*/
</script>