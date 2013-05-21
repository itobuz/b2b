<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <!-- Be sure to leave the brand out there if you want it shown -->
            <a class="brand" href="<?= Yii::app()->baseUrl ?>"><?= Yii::app()->name ?></a>

            <div class="nav-collapse">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'htmlOptions' => array('class' => 'pull-right nav'),
                    'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
                    'itemCssClass' => 'item-test',
                    'encodeLabel' => false,
                    'items' => array(
                        array('label' => 'Admin Menu <span class="caret"></span>', 'url' => '#', 'visible' => Yii::app()->user->checkAccess('Admin'), 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                            'items' => array(
                                array('label' => 'Manage User', 'url' => array('/user/admin')),
                                array('label' => 'Manage Listings', 'url' => array('/listing/admin')),
                                array('label' => 'Manage Live Future Data', 'url' => array('/livefuture/admin')),
                                array('label' => 'Manage Live Spot Data', 'url' => array('/livespot/admin')),
                        )),
                        array('label' => 'Home', 'url' => array('/site/index')),
                        array('label' => 'Trade <span class="caret"></span>', 'url' => '#', 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                            'items' => array(

                                array('label' => 'Create Trade Listing', 'url' => array('/listing/create')),
                        )),
                        array('label' => 'Register', 'url' => array('/user/registration'), 'visible' => Yii::app()->user->isGuest),
                        //array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                        array('label' => 'My Account <span class="caret"></span>', 'url' => '#', 'visible' => !Yii::app()->user->isGuest, 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                            'items' => array(
                                array('label' => 'View Profile', 'url' => array('/user/profile')),
                                array('label' => 'Edit Profile', 'url' => array('/user/profile/edit')),
								array('label' => 'Change Password', 'url' => array('/user/profile/changepassword')),
                                array('label' => 'My Trade Listings', 'url' => array('/listing/mylistings')),

                        )),
                        array('label' => 'Login', 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/user/logout'), 'visible' => !Yii::app()->user->isGuest),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>

