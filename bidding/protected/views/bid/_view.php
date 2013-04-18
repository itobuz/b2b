 
<div class="view  <? if($data->bidStatus == 'approved') { ?> alert-block <? } ?>">

    <span class="pull-right">
        <?
        $logged_user_id = Yii::app()->user->id;
        $listing = Listing::model()->findByPk($data->listId);

        if ($data->bidStatus == 'pending' && ($logged_user_id == $listing->userId)) {
            ?>
            <input type="button" class="btn btn-success" value="Accept"   href="#a00<?= $data->id ?>" data-toggle="modal" >
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" class="btn btn-danger" value="Reject"  href="#r00<?= $data->id ?>" data-toggle="modal">
        <? } else if ($data->bidStatus == 'rejected') { ?> <span class="stat-block alert-error">Bid rejected </span><? } else if ($data->bidStatus == 'approved') { ?> <span class="stat-block alert-success">Bid accepted </span><? } else { ?>
                
<? } ?>
    </span>

    <span class="clear"></span>

    <b>Username:</b>
    <?php
   
    $user = User::model()->findByAttributes(array('id' => $data->userId));
    echo CHtml::encode($user->username);
    ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
<?php echo CHtml::encode($data->amount); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
<?php echo CHtml::encode($data->comment); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('bidStatus')); ?>:</b>
<?php echo CHtml::encode($data->bidStatus); ?>
    <br />
</div>


<? if ($data->bidStatus == 'pending') { ?>

    <div class="modal fade" id="a00<?= $data->id ?>">

        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h3>Accept the bid?</h3>

        </div>
        <div class="modal-body">


            <div class="alert alert-error fade">
                <a class="close" data-dismiss="alert">×</a>  
            </div>
            <b>Username:</b>
            <?php
            $user = User::model()->findByAttributes(array('id' => $data->userId));
            echo CHtml::encode($user->username);
            ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
    <?php echo CHtml::encode($data->amount); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
    <?php echo CHtml::encode($data->comment); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('bidStatus')); ?>:</b>
    <?php echo CHtml::encode($data->bidStatus); ?>
            <br />
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-success" value="Confirm"   href="#" id="ac00<?= $data->id ?>"><a href="#" class="btn" data-dismiss="modal" id="close">Close</a>
        </div>

    </div>

    <div class="modal fade" id="r00<?= $data->id ?>">

        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h3>Reject (and remove) the bid?</h3>

        </div>
        <div class="modal-body">


            <div class="alert alert-error fade">
                <a class="close" data-dismiss="alert">×</a>  
            </div>
            <b>Username:</b>
            <?php
            $user = User::model()->findByAttributes(array('id' => $data->userId));
            echo CHtml::encode($user->username);
            ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
    <?php echo CHtml::encode($data->amount); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
    <?php echo CHtml::encode($data->comment); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('bidStatus')); ?>:</b>
    <?php echo CHtml::encode($data->bidStatus); ?>
            <br />
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" value="Confirm"   href="#" id="rc00<?= $data->id ?>"><a href="#" class="btn" data-dismiss="modal" id="close">Close</a>
        </div>

        <script type="text/javascript">
            jQuery(function($) {
                $('#ac00<?= $data->id ?>').click(function(){
                    var url = '<?php echo Yii::app()->createUrl('bid/confirm', array('pid' => $data->id, 'lid' => $data->listId)) ?>';
                    $.ajax({'url' : url , success: function(data){
                            if(data == 'SUCCESS')
                            {
                                document.location.href = "<? echo Yii::app()->createUrl('listing/view', array('id' => $data->listId, 'confirm' => 'success')) ?>";
                            }
                            else{
                                document.location.href = "<? echo Yii::app()->createUrl('listing/view', array('id' => $data->listId, 'confirm' => 'error')) ?>";
                            }
                        }});
                });
                $('#rc00<?= $data->id ?>').click(function(){
                    var url = '<?php echo Yii::app()->createUrl('bid/reject', array('pid' => $data->id, 'lid' => $data->listId)) ?>';
                    $.ajax({'url' : url , success: function(data){
                            if(data == 'SUCCESS')
                            {
                                document.location.href = "<? echo Yii::app()->createUrl('listing/view', array('id' => $data->listId, 'reject' => 'success')) ?>";
                            }
                            else{
                                document.location.href = "<? echo Yii::app()->createUrl('listing/view', array('id' => $data->listId, 'reject' => 'error')) ?>";
                            }
                        }});
                });
            });
        </script>
    </div>
<? } ?>