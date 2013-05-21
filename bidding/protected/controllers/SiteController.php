<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // 
        // using the default layout 'protected/views/layouts/main.php'
      
        $this->layout = '//layouts/column1_home'; // we are rendering abound theme for the admin, so this layout is not needed for him
        $criteria2 = new CDbCriteria;
        $criteria2->condition = 'showOnHome = 1';
        $liveSpotDataProvider = new CActiveDataProvider('Livespot', array(
                    'criteria' => $criteria2,
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                ));
        $listingData = new CActiveDataProvider('Listing', array(
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                ));
        $newsDataProvider = new CActiveDataProvider('News', array(
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                ));
        $liveFutureDataProvider = new CActiveDataProvider('Livefuture', array(
                    'criteria' => $criteria2,
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                ));
        $this->render('index', array(
            'liveFutureDataProvider' => $liveFutureDataProvider,
            'liveSpotDataProvider' => $liveSpotDataProvider,
            'newsDataProvider' => $newsDataProvider,
            'listingDataProvider' => $listingData
        ));
    }

    public function actionLivePrice() {
         $liveFutureDataProvider = new CActiveDataProvider('Livefuture', array(
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                ));
        $this->render('liveprice', array(
            'liveFutureDataProvider' => $liveFutureDataProvider,
        ));
    }
     
    
    public function actionAbout() {
      
        $this->render('//site/pages/about', array(
           
        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $headers = "From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    public function actionDashboard() {
        $criteria = new CDbCriteria;
        $criteria->with = "bidCount";
        $criteria->condition = 't.userId = ' . Yii::app()->user->id;
        $criteria->together = true;
        $dataProvider = new CActiveDataProvider('Listing', array('criteria' => $criteria));
        $criteria2 = new CDbCriteria;
        $criteria2->with = "list";
        $criteria2->condition = 't.userId = ' . Yii::app()->user->id;
        $criteria2->together = true;
        $sort = new CSort();
        $sort->defaultOrder = 'amount'; // for initial order
        $sort->attributes = array(
            'amount',
            'bidStatus',
            'comment'
        );
        $dataProvider2 = new CActiveDataProvider('Bid', array('criteria' => $criteria2, 'sort' => $sort));
        $this->render('dashboard', array(
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
        ));
    }

    public function actionLoadListingGrid($datatype) {
        $criteria1 = new CDbCriteria;
        $condition = 'status = "active" AND commodityName LIKE "%' . $datatype . '%"';
        $criteria1->condition = $condition;
        $criteria1->limit = 10;

        $listingDataProvider = new CActiveDataProvider('Listing', array(
                    'criteria' => $criteria1,
                    'pagination' => false
                ));

        $this->renderPartial('/site/_latest_listings', array(
            'listingDataProvider' => $listingDataProvider,
            'type' => $datatype
                ), false, true);
    }

    public function actionLoadCities() {

        $id = isset($_REQUEST['sId']) ? $_REQUEST['sId'] : die("0");
        if (!$id)
            die('<option value="">(not set)</option>');
        $city_list = City::model()->findAllByAttributes(array('stateId' => (int) $id));
        $ret = CHtml::listData($city_list, 'id', 'name');
        if (empty($ret)) {
            echo '<option value="">(not set)</option>';
        } else {
            foreach ($ret as $k => $v) {
                echo "<option value='" . $k . "'>" . $v . "</option>";
            }
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}