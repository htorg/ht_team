<?php

namespace backend\controllers;

use Yii;
use common\models\ServicesInfo;
use common\models\searchs\ServicesInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\helpers\UtilHelper;
/**
 * ServicesInfoController implements the CRUD actions for ServicesInfo model.
 */
class ServicesInfoController extends Controller
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
     * Lists all ServicesInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = ServicesInfo::find()->one();
        if (is_object($model))
        {
            return $this->redirect(['services-info/update','id'=>$model->id]);
        }
        else
        {
            return $this->redirect(['services-info/create']);
        }
    }

    /**
     * Displays a single ServicesInfo model.
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
     * Creates a new ServicesInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = ServicesInfo::find()->one();
        if (is_object($model))
        {
            return $this->redirect(['services-info/update','id'=>$model->id]);
        }
        $model = new ServicesInfo();
        $model->created_at=time();
        $model->updated_at=time();
        if (Yii::$app->request->isPost){
            $model->upload_banner=UploadedFile::getInstance($model,'upload_banner');
            if (($file=$model->uploadSettledBanner())!=false){
                $model->banner=$file['src'];
            }
            $model->upload_settled_image=UploadedFile::getInstance($model,'upload_settled_image');
            if (($file=$model->uploadSettledImage())!=false){
                $model->settled_image=$file['src'];
            }
            $model->upload_platform_image=UploadedFile::getInstance($model,'upload_platform_image');
            if (($file=$model->uploadPlatformImage())!=false){
                $model->platform_image=$file['src'];
            }
            $model->upload_banners=UploadedFile::getInstances($model,'upload_banners');
            $files=$model->uploadBanner();
            if ($files!=false){
                $model->banner_files=json_encode($files);
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }else{
                var_dump($model->getErrors());
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ServicesInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $pics=json_decode($model->banner_files);
        //var_dump($pics);die();
        $srcs=array();
        if (!empty($pics)){
            foreach ($pics as $val){
                $srcs['srcs'][]=\Yii::getAlias('@web').$val->src;
            }
        }
        $model->updated_at=time();
        if (Yii::$app->request->isPost){
            $model->upload_banner=UploadedFile::getInstance($model,'upload_banner');
            if (($file=$model->uploadSettledBanner())!=false){
                    UtilHelper::DeleteImg($model->banner);
                $model->banner=$file['src'];
            }
            $model->upload_settled_image=UploadedFile::getInstance($model,'upload_settled_image');
            if (($file=$model->uploadSettledImage())!=false){
                UtilHelper::DeleteImg($model->settled_image);
                $model->settled_image=$file['src'];
            }
            $model->upload_platform_image=UploadedFile::getInstance($model,'upload_platform_image');
            if (($file=$model->uploadPlatformImage())!=false){
                UtilHelper::DeleteImg($model->platform_image);
                $model->platform_image=$file['src'];
            }
            $model->upload_banners=UploadedFile::getInstances($model,'upload_banners');
            $files=$model->uploadBanner();
            if ($files!=false){
                if (!empty($pics)){
                    foreach ($pics as $val){
                        UtilHelper::DeleteImg($val->src);
                    }
                }
                $model->banner_files=json_encode($files);
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                //var_dump($model->attributes);die();
                return $this->redirect(['index']);
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
     * Deletes an existing ServicesInfo model.
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
     * Finds the ServicesInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServicesInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServicesInfo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
