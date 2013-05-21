<style>
    .span7 {
    width: 594px !important;
}
</style>
<div id="breadcrumb_create_listing">
    <span id="step1"><div class="number">1</div> Describe Needs</span>
    <span id="step2"><div class="number">2</div> Add Details</span>
    <span id="step3"><div class="number">3</div> Submit Posting</span>
</div>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'listing-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    ?>
    <div id="ferror"> <?php
    $errors = $form->errorSummary($model);

    if (!empty($errors))
        echo $errors;
    ?></div>
    <div class="row">
        <?php echo $form->labelEx($model, 'orderType'); ?>
        <?php echo ZHtml::enumDropDownList($model, 'orderType', array('class' => 'customSelect')); ?>
    </div>
    <fieldset id="dn">
        <legend><div class="number">1</div> Describe Needs-</legend>
        <div class="row">
            <?php echo $form->labelEx($model, 'commodityName');
           			$data = Listing::model()->getCommodityOptions();
            		$like = Interestedcomm::model()->findByAttributes(array('userId'=>Yii::app()->user->id));
					$model->commodityName = $data[$like->commId]; ?>
            <?php echo ZHtml::enumDropDownList($model, 'commodityName'); ?>

        </div>   
        <div class="row">
            <?php echo $form->labelEx($model, 'productType'); ?>
            <?php echo ZHtml::enumDropDownList($model, 'productType'); ?>
        </div>

        <style>
            .row span:nth-child(5) {
                width: 129px !important;
                margin-left:-6px;
            }
        </style>
        <div class="row sc">
            <label>State/City</label>
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
                ),
                
            );
            ?>
            <?php echo $form->dropDownList($model, 'state', $state_list, $options); ?>

            <?
            $city_list = array();
            $options = array(
                'tabindex' => '0',
                'empty' => '(not set)',
            );
            ?>
            <?php echo $form->dropDownList($model, 'city', $city_list, $options); ?> 
        </div>
    </fieldset>
    <fieldset id="ad">
        <legend><div class="number">2</div> Add details-</legend>


        <div class="row fl">
            <?php echo $form->labelEx($model, 'listingHeading'); ?>
            <?php echo $form->textField($model, 'listingHeading'); ?>
        </div>



       
        <div class="row sc">
            <?php echo $form->labelEx($model, 'orderQty'); ?>
            <?php echo $form->textField($model, 'orderQty', array('class'=>'smallField')); ?>
            <?php echo ZHtml::enumDropDownList($model, 'qtyUnit'); ?>
        </div>
        
         <div class="row">
            <?php echo $form->labelEx($model, 'tradeType'); ?>
            <?php echo $form->radioButtonList($model, 'tradeType', array('fixed price' => 'fixed price', 'receive bids' => 'receive bids'), array('separator' => ' ')); ?>

        </div>
        
        <div class="row sc">
            <?php echo $form->labelEx($model, 'price'); ?>
            <?php echo $form->textField($model, 'price', array('class'=>'smallField')); ?>
            <?php echo ZHtml::enumDropDownList($model, 'priceUnit'); ?>
        </div>
        <div class="row">
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
        
        <div class="row">
            <?php echo $form->labelEx($model, 'paymentTerms'); ?>
            <?php echo ZHtml::enumDropDownList($model, 'paymentTerms'); ?>
        </div>
        <div class="row">
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
        
        <div class="row">
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
        
         <div class="row">
            <?php echo $form->labelEx($model, 'specialRequirments'); ?>
            <?php echo $form->textArea($model, 'specialRequirments', array('rows' => 6, 'cols' => 50)); ?>
        </div>
        

    <!--     <div class="row">
            <?php echo $form->labelEx($model, 'kms'); ?>
            <?php echo $form->textField($model, 'kms'); ?>
        </div> -->


        <div class="row">
            <?php echo $form->labelEx($model, 'commodityTestReport'); ?>
            <?php
            if (!$model->isNewRecord && !empty($model->files)) {
                ?>
                <span class="filelist">
                    <ul>
                        <input type="hidden" class="tobedeleted" name="tobeleted" value=""/>
                        <?php
                        foreach ($model->files as $value) {
                            ?>
                            <li>
                                <input type="hidden" class="fileid" value="<?php echo $value->id ?>"/>
                                <a href="<?php echo Yii::app()->baseUrl ?>/ctest36352/<?php echo $value->file_name ?>" target="_blank"><?php $actual = $value->actual_name;
                    if (!empty($actual)) {
                        echo $actual;
                    } else {
                        echo $value->file_name;
                    } ?></a> <span class="del"></span></li>            
                    <?php
                }
                ?>
                    </ul>
                </span>
                    <?php
                }
                ?>

            <div class="uploads">           
                <?php
                $this->widget('xupload.XUpload', array(
                    'url' => Yii::app()->createUrl("/listing/upload"),
                    //our XUploadForm
                    'model' => $file_model,
                    //We set this for the widget to be able to target our own form
                    'htmlOptions' => array('id' => 'listing-form'),
                    'attribute' => 'commodityTestReport',
                    'multiple' => true,
                        )
                );
                ?>
            </div>
        </div>
        
        <div class="row">
            <?php echo $form->labelEx($model, 'sample'); ?>
            <?php echo ZHtml::enumDropDownList($model, 'sample'); ?>
        </div>
        

       <!--  <div class="row">
            <?php echo $form->labelEx($model, 'deliveryAddress'); ?>
            <?php echo $form->textArea($model, 'deliveryAddress', array('rows' => 6, 'cols' => 50)); ?>
        </div> -->

<!--         <div class="row">
            <?php echo $form->labelEx($model, 'lat'); ?>
<?php echo $form->textField($model, 'lat', array('size' => 50, 'maxlength' => 50)); ?>
        </div>
        <div class="row" style="position:relative">
                <?php echo $form->labelEx($model, 'long'); ?>
                <?php echo $form->textField($model, 'long', array('size' => 50, 'maxlength' => 50)); ?>
            <span id="mapbutton">

                <?php
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
        </div> -->

<?php if (Yii::app()->user->checkAccess('admin')) { ?>
            <div class="row">
            <?php echo $form->labelEx($model, 'status'); ?>
                <?php echo ZHtml::enumDropDownList($model, 'status'); ?>
                <br>
                <br>
            </div>
<?php } ?>
        <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save'); ?>
        </div>
    </fieldset>
    <div class="cb"></div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script src="<?php echo Yii::app()->theme->baseUrl ?>/js/jquery.customSelect.min.js"></script> 
<script>
    $(window).load(function(){
        $('select').customSelect();
    });
</script>
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
                
            $.ajax({
                'type':'POST',
                'url':'<?php echo Yii::app()->createUrl('/site/LoadCities'); ?>',
                'data':{'sId': $("#Listing_state option:selected").val()},
                'cache':false,
                'success':function(data){
                    jQuery("#Listing_city").html(data);
                    jQuery('#Listing_city option[value="<?php echo $model->city ?>"]').attr('selected', 'selected');
                  
                }
            });
                
        }
    
    });
    $('#Listing_tradeType input').change(function(){
        if($(this).val() == 'fixed price')
        {
            $('.pr label').html('Price <span class="required">*</span>');   
        } else
        {
            $('.pr label').html('Price range <span class="required">*</span>');   
        }
    });
    jQuery('.del').click(function(){
        var tobedeleted = $('.tobedeleted').val();        
        var fileid = $(this).parent().find('.fileid').val();
        finalvalue = tobedeleted+','+fileid;
        $('.tobedeleted').val(finalvalue); 
        $(this).parent().hide();   
    });
    jQuery('#dn').click(function(){
        $crumb = $('#breadcrumb_create_listing');
        $crumb.children().removeClass('active');
        $crumb.find('#step1').addClass('active');
    });
    jQuery('#ad').click(function(){
        $crumb = $('#breadcrumb_create_listing');
        $crumb.children().removeClass('active');
        $crumb.find('#step2').addClass('active');
    });
    jQuery('#Listing_orderType').click(function(){
        $crumb = $('#breadcrumb_create_listing');
        $crumb.children().removeClass('active');
    });
    
    
    /*]]>*/
</script>