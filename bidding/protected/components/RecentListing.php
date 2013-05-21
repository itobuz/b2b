<?php

/**
 * RecentPosts is a Yii widget used to display a list of recent posts
 */
class RecentListing extends CWidget
{

    private $_listings;
    public function init(){
		$this->_listings = Listing::model()->getRecentListing();
    }

    public function run(){
	// this method is called by CController::endWidget()   
		$this->render('recentListing');
    }

}