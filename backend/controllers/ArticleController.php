<?php

namespace backend\controllers;

use backend\components\Controller;
use common\models\Article;
use Yii;
use yii\web\NotFoundHttpException;
use common\helpers\DataHelper;
use common\helpers\CategoryHelper;
use common\helpers\UtilHelper;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use common\models\searchs\CmsArticleSearch;
use common\models\CmsArticle;
use yii\base\Object;


/**
 * ArticleController implements the CRUD actions for CmsArticle model.
 */
class ArticleController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'upload','get-sign'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
                'config' => [
                    "imageUrlPrefix"  => "http://www.cloud-sky.xyz/web",//图片访问路径前缀
                    "imagePathFormat" => "/uploads/ueditor/images/{yyyy}{mm}{dd}/{time}{rand:6}", //上传保存路径
                    "imageRoot" => Yii::getAlias("@webroot"),
                ],
            ]
        ];
    }

    /**
     * Lists all CmsArticle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->getView()->title = Yii::t('app', 'Article management');        
        $searchModel = new CmsArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $categoryMap = DataHelper::getCategoryMap();
        $categoryOptions = DataHelper::getCategoryOptions(true);
        $statusMap = CmsArticle::getArticleStatus();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categoryMap' => $categoryMap,
            'statusMap' => $statusMap,
            'categoryOptions' => $categoryOptions
        ]);
    }

    /**
     * Displays a single CmsArticle model.
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
     * Creates a new CmsArticle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $categoryOptions = DataHelper::getCategoryOptions();
        $statusMap = CmsArticle::getArticleStatus();
        $model = new CmsArticle();
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
            $model->video_file = UploadedFile::getInstance($model, 'video_file');
            if (($file = $model->uploadVideoCover())!=false) {
            	$model->video_cover = $file['src'];
            }
            if ($model->load(Yii::$app->request->post()) && $model->save())
            {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'categoryOptions' => $categoryOptions,
            'statusMap' => $statusMap,
        ]);
    }

    /**
     * Updates an existing CmsArticle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $categoryOptions = DataHelper::getCategoryOptions();
        $statusMap = CmsArticle::getArticleStatus();
        
        $model = $this->findModel($id);
        $model->updated_at=time();
        if (Yii::$app->request->isPost) {
            $model->image_main_file = UploadedFile::getInstance($model, 'image_main_file');
            if (($file = $model->uploadImageMain())!=false) {
                UtilHelper::DeleteImg($model->image_main);
                $model->image_main = $file['src'];
            }
            $model->video_file = UploadedFile::getInstance($model, 'video_file');
            if (($file = $model->uploadVideoCover())!=false) {
            	$model->video_cover = $file['src'];
            }
            $model->image_node_file = UploadedFile::getInstance($model, 'image_node_file');
            if (($file = $model->uploadImageNode())!=false) {
                UtilHelper::DeleteImg($model->image_node);
                $model->image_node = $file['src'];
            }
            
            if ($model->load(Yii::$app->request->post()) && $model->save())
            {
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'categoryOptions' => $categoryOptions,
            'statusMap' => $statusMap
        ]);
    }

    /**
     * Deletes an existing CmsArticle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        UtilHelper::DeleteImg($model->image_main);
        UtilHelper::DeleteImg($model->image_node);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CmsArticle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmsArticle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsArticle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
