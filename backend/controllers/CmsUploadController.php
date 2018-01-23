<?php

namespace backend\controllers;

use Yii;
use common\models\CmsUploadFile;
use common\models\searchs\CmsUploadFileSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\helpers\DataHelper;

/**
 * CmsUploadController implements the CRUD actions for CmsUploadFile model.
 */
class CmsUploadController extends Controller
{
    /**
     * @inheritdoc
     */
public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all CmsUploadfile models.
     * @return mixed
     */
    public function actionIndex()
    {    	
    	$site_id = \Yii::$app->params['site_id'];
    	$lang_id = \Yii::$app->params['lang_id'];
        $searchModel = new CmsUploadFileSearch();
        if(isset($_REQUEST['product_id'])){
        	$searchModel->product_id = $_REQUEST['product_id'];
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmsUploadfile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CmsUploadfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	$site_id = \Yii::$app->params['site_id'];
    	$lang_id = \Yii::$app->params['lang_id'];
        $model = new CmsUploadFile();
        $statusMap = DataHelper::getGeneralStatus();
        $model->site_id=$site_id;
        $model->lang_id=$lang_id;
        $model->product_id=\Yii::$app->request->get('product_id','');
        if (Yii::$app->request->isPost) {
        	$model->img_cover = UploadedFile::getInstance($model, 'img_cover');
        	if (($file = $model->uploadCover($site_id))!=false) {
        		$model->cover = $file['src'];
        	}
        	$model->upload_file = UploadedFile::getInstance($model, 'upload_file');
        	if (($file = $model->uploadFile($site_id))!=false) {
        		$model->filePath = $file['src'];
        	}
	        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	            return $this->redirect(['index']);
	        } 
        }
            return $this->render('create', [
                'model' => $model,
            	'statusMap'=>$statusMap	
            ]);
       
    }

    /**
     * Updates an existing CmsUploadfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $site_id = \Yii::$app->params['site_id'];
    	$lang_id = \Yii::$app->params['lang_id'];
        $model = new CmsUploadFile();
        $statusMap = DataHelper::getGeneralStatus();
        $model->site_id=$site_id;
        $model->lang_id=$lang_id;
        $model->product_id=\Yii::$app->request->get('product_id','');
        if (Yii::$app->request->isPost) {
        	$model->img_cover = UploadedFile::getInstance($model, 'img_cover');
        	if (($file = $model->uploadCover($site_id))!=false) {
        		$model->cover = $file['src'];
        	}
        	$model->upload_file = UploadedFile::getInstance($model, 'upload_file');
        	if (($file = $model->uploadFile($site_id))!=false) {
        		$model->filePath = $file['src'];
        	}
	        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	            return $this->redirect(['index']);
	        } 
        }
            return $this->render('update', [
                'model' => $model,
            	'statusMap'=>$statusMap	
            ]);
    }

    /**
     * Deletes an existing CmsUploadfile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CmsUploadfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmsUploadfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsUploadFile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
	