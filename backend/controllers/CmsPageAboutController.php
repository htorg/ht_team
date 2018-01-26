<?php

namespace backend\controllers;

use common\helpers\UtilHelper;
use Yii;
use common\models\CmsPageAbout;
use common\models\searchs\CmsPageAboutSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CmsPageAboutController implements the CRUD actions for CmsPageAbout model.
 */
class CmsPageAboutController extends Controller
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
                    //"imageUrlPrefix"  => "http://cfile.gohoc.com",//图片访问路径前缀
                    "imagePathFormat" => "/uploads/ueditor/images/{yyyy}{mm}{dd}/{time}{rand:6}", //上传保存路径
                    "imageRoot" => Yii::getAlias("@webroot"),
                ],
            ]
        ];
    }
    /**
     * Lists all CmsPageAbout models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = CmsPageAbout::find()->one();
        if (is_object($model))
        {
            return $this->redirect(['cms-page-about/update','id'=>$model->id]);
        }
        else
        {
            return $this->redirect(['cms-page-about/create']);
        }
    }

    /**
     * Displays a single CmsPageAbout model.
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
     * Creates a new CmsPageAbout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = CmsPageAbout::find()->one();
        if (is_object($model))
        {
            return $this->redirect(['cms-page-about/update','id'=>$model->id]);
        }
        $model = new CmsPageAbout();
        $model->created_at=time();
        $model->updated_at=time();
        if (Yii::$app->request->isPost){
            $model->upload_banner=UploadedFile::getInstance($model, 'upload_banner');
            if (($file = $model->uploadBanner())!=false) {

                $model->banner = $file['src'];
            }
            $model->upload_shareholder=UploadedFile::getInstance($model, 'upload_shareholder');
            if (($file = $model->uploadShareholder())!=false) {
                $model->shareholder_detail = $file['src'];
            }
            $model->upload_strategic=UploadedFile::getInstance($model, 'upload_strategic');
            if (($file = $model->uploadStrategic())!=false) {
                $model->Strategic_detail = $file['src'];
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['update', 'id' => $model->id]);
            }else{
                var_dump($model->getErrors());
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CmsPageAbout model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->updated_at=time();
        if (Yii::$app->request->isPost){
            $model->upload_banner=UploadedFile::getInstance($model, 'upload_banner');
            if (($file = $model->uploadBanner())!=false) {
                UtilHelper::DeleteImg($model->banner);
                $model->banner = $file['src'];
            }
            $model->upload_shareholder=UploadedFile::getInstance($model, 'upload_shareholder');
            if (($file = $model->uploadShareholder())!=false) {
                UtilHelper::DeleteImg($model->shareholder_detail);
                $model->shareholder_detail = $file['src'];
            }
            $model->upload_strategic=UploadedFile::getInstance($model, 'upload_strategic');
            if (($file = $model->uploadStrategic())!=false) {
                UtilHelper::DeleteImg($model->Strategic_detail);
                $model->Strategic_detail = $file['src'];
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['update', 'id' => $model->id]);
            }else{
                var_dump($model->getErrors());
            }
        }
        return $this->render('update', [
            'model' => $model,
            'id' => $model->id
        ]);
    }

    /**
     * Deletes an existing CmsPageAbout model.
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
     * Finds the CmsPageAbout model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmsPageAbout the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsPageAbout::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
