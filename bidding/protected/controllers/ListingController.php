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

        $model = Listing::model()->findByPk($id);
        $criteria = new CDbCriteria;
        $criteria->condition = 'listId = ' . (int) $id;
        $criteria->order = 'bidStatus ASC,id DESC';
        Yii::import("xupload.models.XUploadForm");
        $bidding_model = new Bid;
        $bidDataProvider = new CActiveDataProvider('Bid', array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                ));
        $bidding_model = new Bid;
        $files = new XUploadForm;
        if (isset($_POST['Listing'])) {
            $userId = Yii::app()->user->id;
            $model->attributes = $_POST['Listing'];
            if (Yii::app()->user->hasState('commodityTestReport')) {
                $commodityTestReport = Yii::app()->user->getState('commodityTestReport');

                Yii::app()->user->setState('commodityTestReport', null);
            }

            if ($model->save()) {

                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $ulisting = Listing::model()->findAllByAttributes(array('id' => $id, 'userId' => Yii::app()->user->id));
        $MyView = !empty($ulisting) ? TRUE : FALSE;
        $this->render('view', array(
            'model' => $model,
            'file_model' => $files,
            'MyView' => $MyView,
            'bidding_model' => $bidding_model,
            'bidDataProvider' => $bidDataProvider
        ));
    }

    public function actionSubmittedBids() {

        $model = new Listing;
		$criteria = new CDbCriteria;
		//$criteria->select = 't.*';
		//'t.userId != ' . Yii::app()->user->id.' AND '.
		$criteria->condition = 'bid.userId = ' . Yii::app()->user->id;
		$criteria->join = 'RIGHT JOIN bid ON bid.listId=t.id';
        $listProvider = new CActiveDataProvider('Listing', array(
        				'criteria' => $criteria,
        				'pagination' => array(
                        	'pageSize' => 10,
                   		),));
						
        $criteria2 = new CDbCriteria;
        $criteria2->condition = 'userId = 0 ' ;//. (int) Yii::app()->user->id;
		

        $DataProvider = new CActiveDataProvider('Bid', array(
                    'criteria' => $criteria2,
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                ));

        $this->render('bidview_my', array(
            'listProvider' => $listProvider,
            'dataProvider' => $DataProvider,
        ));
    }

    public function actionRecievedBids() {

        $model = new Listing;
		$criteria = new CDbCriteria;
		$criteria->condition = 'userId = ' . Yii::app()->user->id;
        $listProvider = new CActiveDataProvider('Listing', array(
        				'criteria' => $criteria,
        				'pagination' => array(
                        	'pageSize' => 10,
                   		),));
		
        
		$criteria2 = new CDbCriteria;
        $criteria2->with = 'list';
        $criteria2->condition = 'list.userId = 0' ;//. (int) Yii::app()->user->id;
       

        $DataProvider = new CActiveDataProvider('Bid', array(
                    'criteria' => $criteria2,
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                ));

        $this->render('bidview', array(
            'listProvider' => $listProvider,
            'dataProvider' => $DataProvider,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Listing;
        Yii::import("xupload.models.XUploadForm");
        $files = new XUploadForm;
        if (isset($_POST['Listing'])) {
            $userId = Yii::app()->user->id;
            $model->attributes = $_POST['Listing'];
            if (Yii::app()->user->hasState('commodityTestReport')) {
                $commodityTestReport = Yii::app()->user->getState('commodityTestReport');

                Yii::app()->user->setState('commodityTestReport', null);
            }
           

            if ($model->save()) {
				$temp = array();
	            if (isset($commodityTestReport)) {
	                if (!empty($commodityTestReport)) {
	
	                    $temp = array();
						$i = 0;
	                    foreach ($commodityTestReport as $value) {
	                        $temp[$i]['fn'] = isset($value['filename']) ? $value['filename'] : null;
	                        $temp[$i]['on'] = isset($value['name']) ? $value['name'] : null;
							$i++;
	                    }
						//echo "<pre>"; print_r($temp);
						//echo "</pre>";
						//exit();
	                    foreach ($temp as $value) {
	                        $file_table = new Files();
	                        $file_table->list_id = $model->id;
	                        $file_table->file_name = $value['fn'];
	                        $file_table->actual_name = $value['on'];
	                        $file_table->save();
	                    }
	                }
	            }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'file_model' => $files
        ));
    }

    public function actionUpload() {
        Yii::import("xupload.models.XUploadForm");
        //Here we define the paths where the files will be stored temporarily
        $path = Yii::app()->basePath . "/../ctest36352/";
        $publicPath = Yii::app()->getBaseUrl() . "/ctest36352/";
        //This is for IE which doens't handle 'Content-type: application/json' correctly
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT'])
                && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }
        //Here we check if we are deleting and uploaded file
        if (isset($_GET["_method"])) {
            if ($_GET["_method"] == "delete") {
                if ($_GET["file"][0] !== '.') {
                    $file = $path . $_GET["file"];
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
                echo json_encode(true);
                die();
            }
        } else {
            $model = new XUploadForm;
            $model->file = CUploadedFile::getInstance($model, 'commodityTestReport');
            //We check that the file was successfully uploaded
            if ($model->file !== null) {
                //Grab some data
                $model->mime_type = $model->file->getType();
                $model->size = $model->file->getSize();
                $model->name = $model->file->getName();
                $filename = md5(Yii::app()->user->id . microtime() . $model->name);
                $extension = $model->file->getExtensionName();
                $valid_file = preg_match(Yii::app()->params['file_regex'], $extension);
                if (!$valid_file) {

                    echo json_encode(array(
                        array("error" => ": Invalid filetype!",
                            )));
                    Yii::log("XUploadAction: " . CVarDumper::dumpAsString($model->getErrors()), CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction"
                    );
                    die();
                }
                $filename .= "." . $model->file->getExtensionName();
                $actual_file = $model->name;
                if ($model->validate()) {
                    //Move our file to our temporary dir
                    $model->file->saveAs($path . $filename);
                    chmod($path . $filename, 0777);
                    //here you can also generate the image versions you need 
                    //using something like PHPThumb
                    //Now we need to save this path to the user's session
                    if (Yii::app()->user->hasState('commodityTestReport')) {
                        $commodityTestReport = Yii::app()->user->getState('commodityTestReport');
                    } else {
                        $commodityTestReport = array();
                    }
                    $commodityTestReport[] = array(
                        "path" => $path . $filename,
                        //the same file or a thumb version that you generated

                        "filename" => $filename,
                        'size' => $model->size,
                        'mime' => $model->mime_type,
                        'name' => $model->name,
                    );
                    Yii::app()->user->setState('commodityTestReport', $commodityTestReport);
                    echo json_encode(array(array(
                            "name" => $model->name,
                            "actual_file" => $actual_file,
                            "type" => $model->mime_type,
                            "size" => $model->size,
                            "url" => $publicPath . $filename,
                            "delete_url" => $this->createUrl("upload", array(
                                "_method" => "delete",
                                "file" => $filename
                            )),
                            "delete_type" => "POST"
                            )));
                } else {
                    //If the upload failed for some reason we log some data and let the widget know
                    echo json_encode(array(
                        array("error" => $model->getErrors('file'),
                            )));
                    Yii::log("XUploadAction: " . CVarDumper::dumpAsString($model->getErrors()), CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction"
                    );
                }
            } else {
                throw new CHttpException(500, "Could not upload file");
            }
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        Yii::import("xupload.models.XUploadForm");
        $files = new XUploadForm;
        $model = $this->loadModel($id);
        // check for user permission. Admin is allowed to edit everything
        $bidUserId = (int) $model->userId;
        $userId = (int) Yii::app()->user->id;
        $isSuperUser = Yii::app()->user->checkAccess('Admin');
        if (!$isSuperUser && ($bidUserId != $userId))
            throw new CHttpException(400, 'You are not allowed to edit other user\'s listings.');

        if (isset($_POST['Listing'])) {
            if (Yii::app()->user->hasState('commodityTestReport')) {
                $commodityTestReport = Yii::app()->user->getState('commodityTestReport');
            } else {
                $commodityTestReport = array();
            }

            $tobeleted = isset($_POST['tobeleted']) ? $_POST['tobeleted'] : NULL;
            if (!empty($tobeleted)) {
                $tobeleted = trim($tobeleted);
                $arr = explode(',', $tobeleted);

                if (!empty($arr)) {
                    foreach ($arr as $v) {
                        $old_file = Files::model()->findByAttributes(array('id' => $v));

                        if (!empty($old_file)) {

                            $old_file->delete();
                        }
                    }
                }
            }
            if ($model->save()) {
                $temp = array();
                $i = 0;
                foreach ($commodityTestReport as $value) {

                    $temp[$i]['fn'] = $value['filename'];
                    $temp[$i]['on'] = $value['name'];
                    $i++;
                }
                foreach ($temp as $value) {
                    $file_table = new Files();

                    $exists = $file_table->findAllByAttributes(array('list_id' => $model->id, 'file_name' => $value['fn']));
                    $file_table->list_id = $model->id;
                    $file_table->file_name = $value['fn'];
                    $file_table->actual_name = $value['on'];
                    if (empty($exists))
                        $file_table->save();
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $this->render('update', array(
            'model' => $model,
            'file_model' => $files
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            $model = $this->loadModel($id);
            // check for user permission. Admin is allowed to edit everything
            $bidUserId = (int) $model->userId;
            $userId = (int) Yii::app()->user->id;
            $isSuperUser = Yii::app()->user->checkAccess('Admin');
            if (!$isSuperUser && ($bidUserId != $userId))
                throw new CHttpException(400, 'You are not allowed to delete other user\'s listings.');
            // we only allow deletion via POST request
            $model->delete();

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

    public function actionMyOpenListings() {
        $criteria = new CDbCriteria;
        $criteria->condition = "t.userId = " . Yii::app()->user->id . " AND t.id IN(SELECT listId from bid WHERE listId = t.id AND bidStatus != 'approved') || (SELECT count(listId) from bid WHERE listId = t.id) < 1";
        $criteria->group = "id";

        $dataProvider = new CActiveDataProvider('Listing', array('criteria' => $criteria));
        $this->render('indexUser', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionMyClosedListings() {
        $criteria = new CDbCriteria;
        $criteria->join = 'INNER JOIN bid b ON b.listId = t.id';
        $criteria->condition = 't.userId = ' . Yii::app()->user->id . ' AND b.bidStatus = "approved"';

        $dataProvider = new CActiveDataProvider('Listing', array('criteria' => $criteria));
        $this->render('indexUser', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionOpenListings() {
        $criteria = new CDbCriteria;
        $criteria->condition = "t.id IN(SELECT listId from bid WHERE listId = t.id AND bidStatus != 'approved') || (SELECT count(listId) from bid WHERE listId = t.id) < 1";
        $criteria->group = "id";
        $dataProvider = new CActiveDataProvider('Listing', array('criteria' => $criteria));
        $this->render('indexUser_global', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionClosedListings() {
        $criteria = new CDbCriteria;
        $criteria->join = 'LEFT JOIN bid b ON b.listId = t.id';
        $criteria->condition = 'b.bidStatus = "approved"';

        $dataProvider = new CActiveDataProvider('Listing', array('criteria' => $criteria));
        $this->render('indexUser_global', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionSearch($term) {
        $criteria = new CDbCriteria;
        $criteria->join = 'INNER JOIN bid b ON b.listId = t.id';
        $criteria->condition = 'b.bidStatus != "approved" AND (listingHeading LIKE :term OR specialRequirments LIKE :term)';
        $criteria->params[':term'] = "%" . $term . "%";

        $dataProvider = new CActiveDataProvider('Listing', array('criteria' => $criteria));
        $this->render('indexUser_global', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        Yii::app()->theme = 'abound';
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

    public function actionGetBidsByListId($id) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'listId = ' . (int) $id;
        $criteria->order = 'bidStatus ASC,id DESC';
        $bidDataProvider = new CActiveDataProvider('Bid', array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                ));
				
		$model = new Listing;
		$criteria2 = new CDbCriteria;
		$criteria2->condition = 'userId = ' . Yii::app()->user->id;
        $listProvider = new CActiveDataProvider('Listing', array('criteria' => $criteria2));
		
        $this->render('bidview', array(
            'dataProvider' => $bidDataProvider,
             'listProvider' => $listProvider,
        ));
    }
	public function actionGetMyBidsByListId($id) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'listId = ' . (int) $id.' AND userId = '.Yii::app()->user->id;
        $criteria->order = 'bidStatus ASC,id DESC';
        $bidDataProvider = new CActiveDataProvider('Bid', array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                ));
				
		$model = new Listing;
		$criteria2 = new CDbCriteria;
		$criteria2->condition = 'userId = ' . Yii::app()->user->id;
        $listProvider = new CActiveDataProvider('Listing', array('criteria' => $criteria2));
		
        $this->render('bidview_my', array(
            'dataProvider' => $bidDataProvider,
             'listProvider' => $listProvider,
        ));
    }
}
