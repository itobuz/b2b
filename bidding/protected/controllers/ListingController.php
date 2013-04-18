<?php

class ListingController extends Controller {

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

        $bidding_model = new Bid;
        $criteria = new CDbCriteria;
        $criteria->condition = 'listId = ' . (int) $id;
        $criteria->order = 'bidStatus ASC,id DESC';
        $bidDataProvider = new CActiveDataProvider('Bid', array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                ));
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'bidding_model' => $bidding_model,
            'bidDataProvider' => $bidDataProvider
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Listing;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Listing'])) {
            $userId = Yii::app()->user->id;
            $model->attributes = $_POST['Listing'];
            $model->userId = $userId;
            $files = $this->fuploadDoc($model);
            $model->commodityTestReport = $files;

            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        // check for user permission. Admin is allowed to edit everything
        $bidUserId = (int) $model->userId;
        $userId = (int) Yii::app()->user->id;
        $isSuperUser = Yii::app()->user->checkAccess('Admin');
        if (!$isSuperUser && ($bidUserId != $userId))
            throw new CHttpException(400, 'You are not allowed to edit other user\'s listings.');
        $filelist = !empty($model->commodityTestReport) ? explode('|', $model->commodityTestReport) : array();
        if (!empty($filelist) && count($filelist) > 0) {
            $model->commodityTestReport = $filelist;
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Listing'])) {
            $model->attributes = $_POST['Listing'];
            $files = $this->fuploadDoc($model);
            $model->commodityTestReport = $files;
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
        $dataProvider = new CActiveDataProvider('Listing');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionCategory() {
        if (isset($_GET))
            foreach ($_GET as $key => $value) {
                $category = $key;
                break;
            }
        $criteria = new CDbCriteria;
        $criteria->condition = 'commodityName = "' . $category . '"';
        $dataProvider = new CActiveDataProvider('Listing', array('criteria' => $criteria));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionMyListings() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'userId = ' . Yii::app()->user->id;
        $dataProvider = new CActiveDataProvider('Listing', array('criteria' => $criteria));
        $this->render('indexUser', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Listing('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Listing']))
            $model->attributes = $_GET['Listing'];

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
        $model = Listing::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'listing-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function fuploadDoc($model) {
        $path = Yii::getPathOfAlias('webroot') . Yii::app()->params['commTestDir'];
        if (!is_dir($path . $model->commodityTestReport) && !file_exists($path . $model->commodityTestReport)) {
            mkdir($path . $model->commodityTestReport);
            chmod($path . $model->commodityTestReport, 0755);
        }
        $cReports = CUploadedFile::getInstancesByName('commodityTestReport');
        if (isset($cReports) && count($cReports) > 0) {
            $all_files = array();
            foreach ($cReports as $cReport) {
                $random_string = md5(strtotime("now") * rand(0, 999999));
                $orig_name = $cReport->name;
                $temp = explode('.', $orig_name);
                $ext = $temp[count($temp) - 1];
                $new_filename = $random_string . '.' . $ext;
                if ($cReport->saveAs($path . $new_filename)) {
                    $all_files[] = $new_filename;
                }
            }
            return implode('|', $all_files);
        }
    }

}
