<?php
$this->breadcrumbs = array(
    'Listings' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Listing', 'url' => array('index')),
    array('label' => 'Create Listing', 'url' => array('create')),
    array('label' => 'Update Listing', 'url' => array('update', 'id' => $model->id), 'visible' => Yii::app()->user->checkAccess('Admin')|| Yii::app()->user->id == $model->userId),
    array('label' => 'Delete Listing', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?') , 'visible' => Yii::app()->user->checkAccess('Admin')),
    array('label' => 'Manage Listing', 'url' => array('admin'), 'visible' => Yii::app()->user->checkAccess('Admin')),
);
?>
<?
if (isset($_REQUEST['confirm'])) {
    if ($_REQUEST['confirm'] == 'success') {
        ?>
        <div class="alert alert-success" id="status"> The bid has been successfully accepted</div>
    <? } else { ?>
        <div class="alert alert-error" id="status">Error accepting the bid. Please contact administrator for more details.</div>
    <? }
} else
if (isset($_REQUEST['reject'])) {
    if ($_REQUEST['reject'] == 'success') {
        ?>
        <div class="alert alert-success" id="status"> The bid has been successfully rejected</div>
    <? } else { ?>
        <div class="alert alert-error" id="status">Error rejecting the bid. Please contact administrator for more details.</div>
    <? }
} ?> 
  <? if( $model->userId != Yii::app()->user->id) {?>

<div class="alert alert-success fade">
</div>
<div class="clear"></div>


<div class="pull-right"><input type="button" class="btn-primary" value="Bid on this project"  href="#bid_modal" data-toggle="modal"></div>



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
<h1>View Listing #<?php echo $model->listingHeading; ?></h1>
<?php
$stateById = State::model()->find(array('condition' => 'id =' . $model->state));
$state = CHtml::value($stateById, 'name');
$username = User::model()->findByPk($model->userId);
$cityById = City::model()->find(array('condition' => 'id =' . $model->city));
$city = CHtml::value($cityById, 'name');
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'Posted by',
            'value' => $username->username,
        ),
        'orderType',
        'commodityName',
        'productType',
        'orderQty',
        'deliveryDate',
        'paymentDate',
        'price',
        array(
            'name' => 'state',
            'value' => $state,
        ),
        array(
            'name' => 'city',
            'value' => $city,
        )
        ,
        'kms',
        'paymentTerms',
        'expireTime',
        'tradeType',
        'specialRequirments',
        array(
            'name' => 'commodityTestReport',
            'type' => 'raw',
            'value' => $model->prepareReportLinks(),
        ),
        'deliveryAddress',
        'lat',
        'long',
    ),
));
?>
<h2>Bids</h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$bidDataProvider,
	'itemView'=>'/bid/_view',
)); ?>