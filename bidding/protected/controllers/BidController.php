<?php

class BidController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'rights', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Bid;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Bid'])) {
            $model->attributes = $_POST['Bid'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionCreateAjax() {
        $model = new Bid;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Bid'])) {

            $model->attributes = $_POST['Bid'];
            $model->userId = Yii::app()->user->id;
            $result = Bid::model()->findByAttributes(array('userId' => $model->userId, 'listId' => $model->listId));
            if (isset($result->id))
                if (!empty($result->id))
                    die('exists');
            if ($model->save()) {
                die("success");
            }
        }

        $this->render('create_ajax', array(
            'model' => $model,
        ));
    }

    public function actionConfirm() {
        $bid_id = isset($_REQUEST['pid']) ? (int) $_REQUEST['pid'] : die('NOPID');
        $list_id = isset($_REQUEST['lid']) ? (int) $_REQUEST['lid'] : die('NOLID');
        // current bids if any. If any other bid is accepted then make it pending.
        
        $existing_bids = Bid::model()->findAllByAttributes(array('bidStatus' => 'approved', 'listId' => $list_id));
        if (!empty($existing_bids)) {
            foreach ($existing_bids as $row) {
                $row->bidStatus = 'pending';
                $row->save();
            }
        }
        unset($existing_bids);
        // new bids
        $bid = Bid::model()->findByPk($bid_id);
        $logged_user_id = Yii::app()->user->id;
        $listing = Listing::model()->findByPk($list_id);
        if(!($logged_user_id == $listing->userId))
            return;
        $bid->bidStatus = 'approved';
        if ($bid->save())
            die('SUCCESS');
        else
            die('ERROR');
    }

    public function actionReject() {
        $bid_id = isset($_REQUEST['pid']) ? (int) $_REQUEST['pid'] : die('NOPID');
        $list_id = isset($_REQUEST['lid']) ? (int) $_REQUEST['lid'] : die('NOLID');
        $bid = Bid::model()->findByPk($bid_id);
        $bid->bidStatus = 'rejected';
        if ($bid->save())
            die('SUCCESS');
        else
            die('ERROR');
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Bid'])) {
            $model->attributes = $_POST['Bid'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Bid');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Bid('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Bid']))
            $model->attributes = $_GET['Bid'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Bid::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'bid-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
