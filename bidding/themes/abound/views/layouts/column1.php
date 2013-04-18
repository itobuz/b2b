<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="content">
     
 <?php
        foreach (Yii::app()->user->getFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
        }
        ?>
    <?php
    foreach (Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
    }
    ?>
    <?php if (isset($this->breadcrumbs)): ?>
        <?php
        $this->widget('zii.widgets.CBreadcrumbs', array(
            'links' => $this->breadcrumbs,
            'homeLink' => CHtml::link('Dashboard'),
            'htmlOptions' => array('class' => 'breadcrumb')
        ));
        ?><!-- breadcrumbs -->
    <?php endif ?>

<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>