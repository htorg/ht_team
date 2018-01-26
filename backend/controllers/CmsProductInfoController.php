<?php

namespace backend\controllers;

use common\helpers\UtilHelper;
use common\models\CmsProduct;
use Yii;
use common\models\CmsProductInfo;
use common\models\searchs\CmsProductInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CmsProductInfoController implements the CRUD actions for CmsProductInfo model.
 */
class CmsProductInfoController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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
                    "imageUrlPrefix"  => "",//图片访问路径前缀
                    "imagePathFormat" => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}" ,//上传保存路径
                    'imageRoot' => Yii::getAlias("@webroot"),
            ],
        ]
    ];
    }
    public function actionIndex()
    {
        if (!isset($_REQUEST['product_id']))
        {
            throw new NotFoundHttpException('404');
        }
        $product = CmsProduct::findOne($_REQUEST['product_id']);
        if (!is_object($product))
        {
            throw new NotFoundHttpException('404');
        }
        $searchModel = new CmsProductInfoSearch();
        $searchModel->product_id = $_REQUEST['product_id'];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmsProductInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        if (!isset($_REQUEST['product_id']))
        {
            throw new NotFoundHttpException('404');
        }
        $product = CmsProduct::findOne($_REQUEST['product_id']);
        if (!is_object($product))
        {
            throw new NotFoundHttpException('404');
        }
        $model = new CmsProductInfo();
        $model->created_at=time();
        $model->updated_at=time();
        $model->product_id=$_REQUEST['product_id'];
        if (Yii::$app->request->isPost){
            $model->upload_main_image=UploadedFile::getInstance($model,'upload_main_image');
            if (($file=$model->uploadMainImage())!=false){
                $model->main_image=$file['src'];
            }
            $model->upload_node_image=UploadedFile::getInstance($model,'upload_node_image');
            if (($file=$model->uploadNodeImage())!=false){
                $model->node_image=$file['src'];
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index','product_id'=>$_REQUEST['product_id']]);
            }else{
                var_dump($model->getErrors());
            }
        }


        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CmsProductInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated_at=time();
        if (Yii::$app->request->isPost){
            $model->upload_main_image=UploadedFile::getInstance($model,'upload_main_image');
            if (($file=$model->uploadMainImage())!=false){
                $model->main_image=$file['src'];
            }
            $model->upload_node_image=UploadedFile::getInstance($model,'upload_node_image');
            if (($file=$model->uploadNodeImage())!=false){
                $model->node_image=$file['src'];
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index','product_id'=>$model->product_id]);
            }else{
                var_dump($model->getErrors());
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CmsProductInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        UtilHelper::DeleteImg($model->main_image);
        UtilHelper::DeleteImg($model->node_image);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the CmsProductInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmsProductInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsProductInfo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
