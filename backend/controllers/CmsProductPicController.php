<?php

namespace backend\controllers;

use common\helpers\UtilHelper;
use common\models\CmsProduct;
use Yii;
use common\models\CmsProductPic;
use common\models\searchs\CmsProductPicSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CmsProductPicController implements the CRUD actions for CmsProductPic model.
 */
class CmsProductPicController extends Controller
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

    /**
     * Lists all CmsProductPic models.
     * @return mixed
     */
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
        $searchModel = new CmsProductPicSearch();
        $searchModel->product_id = $_REQUEST['product_id'];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmsProductPic model.
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
     * Creates a new CmsProductPic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CmsProductPic();
        if (!isset($_REQUEST['product_id']))
        {
            throw new NotFoundHttpException('404');
        }
        $product = CmsProduct::findOne($_REQUEST['product_id']);
        if (!is_object($product))
        {
            throw new NotFoundHttpException('404');
        }
        $model->product_id=$_REQUEST['product_id'];
        $model->created_at=time();
        $model->updated_at=time();
        if (Yii::$app->request->isPost){
            $model->upload_banner=UploadedFile::getInstance($model,'upload_banner');
            if (($file=$model->uploadBanner())!=false){
                $model->sub_banner=$file['src'];
            }
            $model->upload_image1=UploadedFile::getInstance($model,'upload_image1');
            if (($file=$model->uploadImage1())!=false){
                $model->info_img1=$file['src'];
            }
            $model->upload_image2=UploadedFile::getInstance($model,'upload_image2');
            if (($file=$model->uploadImage2())!=false){
                $model->info_img2=$file['src'];
            }
            $model->upload_image3=UploadedFile::getInstance($model,'upload_image3');
            if (($file=$model->uploadImage3())!=false){
                $model->info_img3=$file['src'];
            }
            $model->upload_show_pics=UploadedFile::getInstances($model,'upload_show_pics');
            $files=$model->uploadImageShowPics();
            if ($files!=false){
                $model->show_pics=json_encode($files);
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index', 'product_id' => $model->product_id]);
            }else{
                var_dump($model->getErrors());
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CmsProductPic model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated_at=time();
        $pics=json_decode($model->show_pics);
        //var_dump($pics);die();
        $srcs=array();
        if (!empty($pics)){
            foreach ($pics as $val){
                $srcs['srcs'][]=\Yii::getAlias('@web').$val->src;
                $srcs['titles'][]=$val->name;
            }
        }
        if (Yii::$app->request->isPost){
            $model->upload_banner=UploadedFile::getInstance($model,'upload_banner');
            if (($file=$model->uploadBanner())!=false){
                UtilHelper::DeleteImg($model->sub_banner);
                $model->sub_banner=$file['src'];
            }
            $model->upload_image1=UploadedFile::getInstance($model,'upload_image1');
            if (($file=$model->uploadImage1())!=false){
                UtilHelper::DeleteImg($model->info_img1);
                $model->info_img1=$file['src'];
            }
            $model->upload_image2=UploadedFile::getInstance($model,'upload_image2');
            if (($file=$model->uploadImage2())!=false){
                UtilHelper::DeleteImg($model->info_img2);
                $model->info_img2=$file['src'];
            }
            $model->upload_image3=UploadedFile::getInstance($model,'upload_image3');
            if (($file=$model->uploadImage3())!=false){
                UtilHelper::DeleteImg($model->info_img3);
                $model->info_img3=$file['src'];
            }
            $model->upload_show_pics=UploadedFile::getInstances($model,'upload_show_pics');
            $files=$model->uploadImageShowPics();
            if ($files!=false){
                if (!empty($pics)){
                    foreach ($pics as $val){
                        UtilHelper::DeleteImg($val->src);
                    }
                }
                $model->show_pics=json_encode($files);
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index', 'product_id' => $model->product_id]);
            }else{
                var_dump($model->getErrors());
            }
        }

        return $this->render('update', [
            'model' => $model,
            'srcs'=>$srcs
        ]);
    }

    /**
     * Deletes an existing CmsProductPic model.
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
     * Finds the CmsProductPic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmsProductPic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsProductPic::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
