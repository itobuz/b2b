
    <?php
$listings = Listing::model()->getRecentListing()
	?> 
<div class="row-fluid">
    <ul>   
 <?  foreach ($listings as $listing): ?>
        <li>
            <h5>
		    <?php echo CHtml::encode($listing->listingHeading); ?>
	    </h5>
	    <p>
		    <?php echo CHtml::encode($listing->orderQty); ?>
	    </p>
	    <p class="link">
		<?php echo CHtml::link('View More', array('/listing/view', 'id' => $listing->id)); ?>
	    </p>
        </li>
            <?php endforeach; ?>
             </ul>
</div>
       

    