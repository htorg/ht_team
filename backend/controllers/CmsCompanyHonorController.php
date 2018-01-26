<?php

namespace backend\controllers;

use Yii;
use common\models\CmsCompanyHonor;
use common\models\searchs\CmsCompanyHonorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CmsCompanyHonorController implements the CRUD actions for CmsCompanyHonor model.
 */
class CmsCompanyHonorController extends Controller
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
     * Lists all CmsCompanyHonor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = CmsCompanyHonor::find()->one();
        if (is_object($model))
        {
            return $this->redirect(['cms-company-honor/update','id'=>$model->id]);
        }
        else
        {
            return $this->redirect(['cms-company-honor/create']);
        }
    }

    /**
     * Displays a single CmsCompanyHonor model.
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
     * Creates a new CmsCompanyHonor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = CmsCompanyHonor::find()->one();
        if (is_object($model))
        {
            return $this->redirect(['cms-company-honor/update','id'=>$model->id]);
        }
        $model = new CmsCompanyHonor();
        $model->created_at=time();
        $model->updated_at=time();
        if (Yii::$app->request->isPost){
            $model->upload_banner=UploadedFile::getInstance($model, 'upload_banner');
            if (($file = $model->uploadBanner())!=false) {

                $model->banner = $file['src'];
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
     * Updates an existing CmsCompanyHonor model.
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
                $model->banner = $file['src'];
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }else{
                var_dump($model->getErrors());die();
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CmsCompanyHonor model.
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
     * Finds the CmsCompanyHonor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmsCompanyHonor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsCompanyHonor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
