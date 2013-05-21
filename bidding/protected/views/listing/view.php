<?php
$this->breadcrumbs = array(
    'Dashboard',
    'view listing',
);
$this->layout = "//layouts/column1";
Yii::app()->clientScript->registerCoreScript('jquery');


if (!$MyView) {
    $stateById = State::model()->find(array('condition' => 'id =' . $model->state));
    $state = CHtml::value($stateById, 'name');
    $username = User::model()->findByPk($model->userId);
    $cityById = City::model()->find(array('condition' => 'id =' . $model->city));
    $city = CHtml::value($cityById, 'name');
    $files = $model->files;
    $filelist = '<ul>';
    if (!empty($files) && is_array($files)) {
        foreach ($files as $file) {
            $filelist .= '<li> <a href="' . Yii::app()->baseUrl . '/' . Yii::app()->params['commTestDir'] . $file->file_name . '">' . $file->file_name . '</a></li>';
        }
    } else {
        $filelist .= '<li> No files uploaded</li>';
    }
    $filelist .= '<ul>';
    ?>
    <style>
        .btn a , .btn a:hover { color:#fff !important}
        #main_content fieldset legend
        {
            height: 22px;
        }
        .row{
            margin-left: 20px !important;
        }

        .row span:nth-child(5) {
            width: 129px !important;
            margin-left:-6px;
        }
        #main_content textarea {
            background: none repeat scroll 0 0 #D1D1D1  !important;
            height: 100% !important;
            width: 500px  !important;
        }
    </style>

    <?
    if (isset($_REQUEST['confirm'])) {
        if ($_REQUEST['confirm'] == 'success') {
            ?>
            <div class="alert alert-success" id="status"> The bid has been successfully accepted</div>
        <? } else { ?>
            <div class="alert alert-error" id="status">Error accepting the bid. Please contact administrator for more details.</div>
            <?
        }
    } else
    if (isset($_REQUEST['reject'])) {
        if ($_REQUEST['reject'] == 'success') {
            ?>
            <div class="alert alert-success" id="status"> The bid has been successfully rejected</div>
        <? } else { ?>
            <div class="alert alert-error" id="status">Error rejecting the bid. Please contact administrator for more details.</div>
            <?
        }
    }
    ?> 
    <? if ($model->userId != Yii::app()->user->id) { ?>

        <div class="alert alert-success fade">
        </div>
        <div class="clear"></div>

        <div class="pull-right"><input type="button" class="listing_buttons expire_button" value="Bid on this project"  href="#bid_modal" data-toggle="modal"></div>



        <div class="modal fade" id="bid_modal">
            <?
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'bid-form',
                'enableAjaxValidation' => true,
                'action' => Yii::app()->controller->createUrl('/bid/createAjax'),
                'htmlOptions' => array(
                    'data-async data-target' => '#bid_modal'
                )
                    ));
            ?>

            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h3>Bid on <?php echo $model->listingHeading; ?></h3>
            </div>
            <div class="modal-body">


                <div class="alert alert-error fade">
                    <a class="close" data-dismiss="alert">×</a>  
                </div>

                <fieldset>

                    <div class="control-group">

                        <div class="control-group">

                            <input type="hidden" name="Bid[listId]" value="<?= $model->id ?>"/>

                            <!-- Text input-->
                            <label class="control-label" for="input01">Your Bid Amound</label>
                            <div class="controls">
                                <?php echo $form->textField($bidding_model, 'amount', array('class' => "input-xlarge")); ?>
                                <p class="help-block">Amount should be an integer greater than 0</p>
                            </div>
                        </div>


                        <!-- Textarea -->
                        <label class="control-label">Comments</label>
                        <div class="controls">
                            <div class="textarea">
                                <?php echo $form->textArea($bidding_model, 'comment', array('size' => 60, 'maxlength' => 1024, 'style' => 'margin: 0px;width: 270px;height: 117px;')); ?>

                            </div>
                        </div>
                    </div>


                </fieldset>


            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal" id="close">Close</a>

                <?php echo CHtml::submitButton('Place Bid', array('class' => 'btn btn-primary')); ?>
            </div>
            <?php $this->endWidget(); ?>
            <script type="text/javascript">
                jQuery(function($) {
                    $('#bid-form').live('submit', function(event) {
                        var $form = $(this);
                        var $target = $($form.attr('data-target'));
                                                                                        
                        $.ajax({
                            type: $form.attr('method'),
                            url: $form.attr('action'),
                            data: $form.serialize(),
                                                                         
                            success: function(data, status) {
                                                                                                
                                if( data == 'success'){
                                    $('#bid_modal').modal('hide');
                                    $('.alert-success').html('You have placed the bid successfully').removeClass('fade');
                                                                                                    
                                }else if( data == 'exists'){
                                    $('.alert-error').html('<p>You have already placed bid on this project.</p>');
                                    $('.alert-error').removeClass('fade');
                                }
                                else{
                                    var ret =  $.parseJSON(data);
                                    var str = "";
                                    jQuery.each(ret, function() {
                                        str += '<p>'+this+'</p>';
                                    });
                                    $('.alert-error').html(str);
                                    $('.alert-error').removeClass('fade');
                                }
                            }
                        });
                                                                                        
                        event.preventDefault();
                    });
                    $('#close ,.close').click(function(){
                        $('.alert-error').html('');
                        $('.alert-error').addClass('fade');
                    });
                });
            </script>
        </div>
    <? } else { ?>

    <? } ?>
    <div class="clear"></div>
    <div class="row">
        <br>
        <h2><?php echo $model->listingHeading ?></h2>
    </div>

    <div class="form">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'listing-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
                ));
        ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'orderType'); ?>
            <?php echo ZHtml::enumDropDownList($model, 'orderType', array('class' => 'customSelect')); ?>
        </div>
        <fieldset class="dn">
            <legend>&nbsp;</legend>
        </fieldset>

        <div class="row">
            <?php echo $form->labelEx($model, 'commodityName');?>
            <?php echo ZHtml::enumDropDownList($model, 'commodityName'); ?>
        </div>  
        <div class="row">
            <?php echo $form->labelEx($model, 'productType'); ?>
            <?php echo ZHtml::enumDropDownList($model, 'productType'); ?>
        </div>


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
                )
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
        <fieldset class="dn">
            <legend>&nbsp;</legend>
        </fieldset>

        <div class="row sc">
            <?php echo $form->labelEx($model, 'orderQty'); ?>
            <?php echo $form->textField($model, 'orderQty', array('class'=>'smallField')); ?>
            <?php echo ZHtml::enumDropDownList($model, 'qtyUnit'); ?>
        </div>
        <div class="row">
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
        <div class="row">

            <?php
            if (!empty($model->files)) {
                echo $form->labelEx($model, 'commodityTestReport');
                ?>
                <span class="filelist">
                    <ul>

                        <?php
                        foreach ($model->files as $value) {
                            ?>
                            <li>
                                <a href="<?php echo Yii::app()->baseUrl ?>/ctest36352/<?php echo $value->file_name ?>" target="_blank"><?php echo $value->file_name ?></a>
                            </li>            
                            <?php
                        }
                        ?>
                    </ul>
                </span>
                <?php
            }
            ?>


        </div>
    </div>
    <?php $this->endWidget(); ?>
    <div class="row">


        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $bidDataProvider,
            'itemView' => '/bid/_view',
            'cssFile' => false,
            'template' => '{items}',
            'itemsCssClass' => 'bids'
        ));
        ?>
    </div>

    <script src="<?php echo Yii::app()->theme->baseUrl ?>/js/jquery.customSelect.min.js"></script> 
    <script src="<?php echo Yii::app()->theme->baseUrl ?>/js/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('select').customSelect();
        });
    </script>
    <script type="text/javascript">
        $('.expire_button').click(function(){
            $('#test_modal').modal('show');
        });
    </script>
    <script type="text/javascript">
        $('#test_modal').modal('hide')
    </script>

    <?php
} else {

    $stateById = State::model()->findByAttributes(array('id' => $model->state));
    $state = CHtml::value($stateById, 'name');
    $username = User::model()->findByPk($model->userId);
    $cityById = City::model()->find(array('condition' => 'id =' . $model->city));
    $city = CHtml::value($cityById, 'name');
    $files = $model->files;
    $filelist = '<ul>';
    if (!empty($files) && is_array($files)) {
        foreach ($files as $file) {
            $filelist .= '<li> <a href="' . Yii::app()->baseUrl . '/' . Yii::app()->params['commTestDir'] . $file->file_name . '">' . $file->file_name . '</a></li>';
        }
    } else {
        $filelist .= '<li> No files uploaded</li>';
    }
    $filelist .= '<ul>';
    ?>
    <style>
        .row span:nth-child(5) {
            width: 129px !important;
            margin-left:-6px;
        }
        #main_content fieldset legend
        {
            height: 22px;
        }
        .row{
            margin-left: 20px !important;
        }

    </style>
    <p>
        You have recieved <b><span class="red"><?php echo $model->bidCount ?></span> Bids</b> from various Sellers</p>
    <div class="row">
        <input type="button"  class="listing_buttons" onClick="document.location.href='<?php echo Yii::app()->createUrl('/listing/create') ?>'" value="create new"/>
        <input type="button"  class="listing_buttons" onClick="expireListing()" value="expire listing"/>
        <input type="button"  class="listing_buttons" onClick="document.location.href='<?php echo Yii::app()->createUrl('/listing/mylistings') ?>'" value="manage listing"/>
        <input type="button"  class="listing_buttons" onClick="document.location.href='<?php echo Yii::app()->createUrl('/listing/update/', array('id' => $model->id)) ?>'" value="edit listing"/>
        <div class="clear"></div>
    </div>
    <div class="row">
        <br>
        <h2><?php echo $model->listingHeading ?></h2>
    </div>

    <div class="form">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'listing-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
                ));
        ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'orderType'); ?>
            <?php echo ZHtml::enumDropDownList($model, 'orderType', array('class' => 'customSelect')); ?>
        </div>
        <fieldset class="dn">
            <legend>&nbsp;</legend>
        </fieldset>


        <div class="row">
            <?php echo $form->labelEx($model, 'commodityName');  ?>
            <?php echo ZHtml::enumDropDownList($model, 'commodityName'); ?>
        </div>  
        <div class="row">
            <?php echo $form->labelEx($model, 'productType'); ?>
            <?php echo ZHtml::enumDropDownList($model, 'productType'); ?>
        </div>


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
                )
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
        <fieldset class="dn">
            <legend>&nbsp;</legend>
        </fieldset>

        <div class="row sc">
            <?php echo $form->labelEx($model, 'orderQty'); ?>
            <?php echo $form->textField($model, 'orderQty', array('class'=>'smallField')); ?>
            <?php echo ZHtml::enumDropDownList($model, 'qtyUnit'); ?>
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
                                <a href="<?php echo Yii::app()->baseUrl ?>/ctest36352/<?php echo $value->file_name ?>" target="_blank"><?php
                $actual = $value->actual_name;
                if (!empty($actual)) {
                    echo $actual;
                } else {
                    echo $value->file_name;
                }
                            ?></a> </li>            
                            <?php
                        }
                        ?>
                    </ul>
                </span>
                <?php
            }
            ?>


        </div>
        <div class="row buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        </div>
        <div class="row">


            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $bidDataProvider,
                'itemView' => '/bid/_view',
                'cssFile' => false,
                'template' => '{items}',
                'itemsCssClass' => 'bids'
            ));
            ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
    <script src="<?php echo Yii::app()->theme->baseUrl ?>/js/jquery.customSelect.min.js"></script> 
    <script src="<?php echo Yii::app()->theme->baseUrl ?>/js/bootstrap/js/bootstrap.min.js"></script>

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
                    
                jQuery.ajax({
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
        })
      
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

    <?php
}
?>