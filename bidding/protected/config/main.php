<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Bidding Site',
    //'defaultController' => 'site/contact',
// preloading 'log' component
    'preload' => array('log'),
    'theme' => 'abound',
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
        'ext.bootstrap.widgets.BootPager',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
    ),
    'modules' => array(
// uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'rights' => array(
            'install' => false,
            'superuserName' => 'Admin', // Name of the role with super user privileges. 
            'authenticatedName' => 'Authenticated', // Name of the authenticated user role. 
            'userIdColumn' => 'id', // Name of the user id column in the database. 
            'userNameColumn' => 'username', // Name of the user name column in the database. 
        ),
        'user' => array(
            'tableUsers' => 'users',
            'tableProfiles' => 'profiles',
            'tableProfileFields' => 'profiles_fields',
            'sendActivationMail' => false,
            'activeAfterRegister' => true
        ),
    ),
    // application components
    'components' => array(
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
            'pathViews' => 'application.views.email',
            'pathLayouts' => 'application.views.email.layouts'
        ),
        'user' => array(
            'class' => 'RWebUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('/user/login'),
        ),
        'authManager' => array(
            'class' => 'RDbAuthManager',
            'connectionID' => 'db',
            'defaultRoles' => array('Guest'),
            'assignmentTable' => 'authassignment',
            'itemTable' => 'authitem',
            'itemChildTable' => 'authitemchild',
            'rightsTable' => 'rights',
        ), /*
         * 'authManager' => array(
          'class' => 'RDbAuthManager',

          ),
         */
        'gplus' => array(
            'class' => 'ext.gplus.gplus',
            'clientId' => 'ersewrws',
            'clientSecret' => 'efrwer',
            'redirectUri' => "sdfsdsdf",
            'developerKey' => 'adsasdsd'
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                'users/<slug:[a-zA-Z0-9-]+>' => 'user/user/view',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
//		
//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
// uncomment the following to use a MySQL database

        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=bidding',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'widgetFactory' => array(
            'widgets' => array(
                'CGridView' => array(
                    'htmlOptions' => array('cellspacing' => '0', 'cellpadding' => '0'),
                    'itemsCssClass' => 'table table-striped table-hover table-bordered table-condensed',
                    'pagerCssClass' => 'pager-class'
                ),
            ),
        ),
        'errorHandler' => array(
// use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
// using Yii::app()->params['paramName']
    'params' => array(
// this is used in contact page
        'adminEmail' => 'thcdesigning@gmail.com',
        'adminName' => 'Bidding Admin',
        'commTestDir' => '/ctest36352/',
        'allowedTypes' => array('jpeg', 'jpg', 'gif', 'png', 'pdf', 'rtf', 'doc', 'docx', 'xls', 'xlsx', 'csv', 'txt'),
        'maxUploadSize' => 20 * 1024 * 1024
    ),
);