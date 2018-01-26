<?php

namespace backend\controllers;

use backend\components\Controller;
use Yii;
use common\models\CmsCategory;
use common\models\searchs\CmsCategorySearch;
use yii\web\NotFoundHttpException;
use common\helpers\DataHelper;
use common\helpers\CategoryHelper;
use common\helpers\UtilHelper;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\base\Object;
use common\helpers\SiteHelper;

/**
 * CategoryController implements the CRUD actions for CmsCategory model.
 */
class CategoryController extends Controller
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
     * Lists all CmsCategory models.
     * @return mixed
     */
    public function actionIndex()
    {        
        $this->getView()->title = Yii::t('app', 'Category management');        
        $searchModel = new CmsCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        
        $categoryMap = DataHelper::getCategoryMap();
        $categoryOptions = DataHelper::getCategoryOptions();
        $statusMap = CmsCategory::getCategoryStatus();
        $type=Yii::$app->request->get('type',0);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categoryMap' => $categoryMap,
            'statusMap' => $statusMap,
            'categoryOptions' => $categoryOptions,
            'type'=>$type
        ]);
    }

    /**
     * Displays a single CmsCategory model.
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
     * Creates a new CmsCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $categoryOptions = DataHelper::getCategoryOptions();
        $statusMap = CmsCategory::getCategoryStatus();
        $type=Yii::$app->request->get('type',0);
        $model = new CmsCategory();
        $model->sort_val = 10;
		$model->created_at=time();
		$model->updated_at=time();
        if (Yii::$app->request->isPost) {
            $model->image_main_file = UploadedFile::getInstance($model, 'image_main_file');
            if (($file = $model->uploadImageMain())!=false) {
                $model->image_main = $file['src'];
            }
            $model->image_node_file = UploadedFile::getInstance($model, 'image_node_file');
            if (($file = $model->uploadImageNode())!=false) {
                $model->image_node = $file['src'];
            }
            $model->banner_file = UploadedFile::getInstance($model, 'banner_file');
            if (($file = $model->uploadBanner())!=false) {
                $model->banner = $file['src'];
            }

            if ($model->load(Yii::$app->request->post()) && $model->save())
            {
                DataHelper::deleteCache();
                return $this->redirect(['index']);
            }else{
                var_dump($model->getErrors());die();
            }
        }
        return $this->render('create', [
            'model' => $model,
            'categoryOptions' => $categoryOptions,
            'statusMap' => $statusMap,
            'type'=>$type
        ]);
    }

    /**
     * Updates an existing CmsCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $categoryOptions = DataHelper::getCategoryOptions();
        $statusMap = CmsCategory::getCategoryStatus();
        $model = $this->findModel($_GET['id']);
        if (Yii::$app->request->isPost) {
            $model->image_main_file = UploadedFile::getInstance($model, 'image_main_file');
            if (($file = $model->uploadImageMain())!=false) {
                UtilHelper::DeleteImg($model->image_main);
                $model->image_main = $file['src'];
            }
            $model->image_node_file = UploadedFile::getInstance($model, 'image_node_file');
            if (($file = $model->uploadImageNode())!=false) {
                UtilHelper::DeleteImg($model->image_node);
                $model->image_node = $file['src'];
            }
            $model->banner_file = UploadedFile::getInstance($model, 'banner_file');
            if (($file = $model->uploadBanner())!=false) {
                UtilHelper::DeleteImg($model->banner);
                $model->banner = $file['src'];
            }
            
            if ($model->load(Yii::$app->request->post()) && $model->save())
            {
                DataHelper::deleteCache();
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'categoryOptions' => $categoryOptions,
            'statusMap' => $statusMap,
        ]);
    }

    /**
     * Deletes an existing CmsCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);        
            SiteHelper::delete($model->image_main);
            SiteHelper::delete($model->image_node);
           	SiteHelper::delete($model->banner);
            $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the CmsCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmsCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
