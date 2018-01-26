<?php

namespace backend\controllers;

use common\helpers\UtilHelper;
use Yii;
use common\models\UploadFiles;
use common\models\searchs\UploadFilesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UploadFilesController implements the CRUD actions for UploadFiles model.
 */
class UploadFilesController extends Controller
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
                    'delete' => ['POST','GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all UploadFiles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UploadFilesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UploadFiles model.
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
     * Creates a new UploadFiles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UploadFiles();
        $model->created_at=time();
        $model->updated_at=time();
        if(\Yii::$app->request->isPost){
            $model->upload_file = UploadedFile::getInstance($model, 'upload_file');
            if (($file = $model->uploadFile())!=false) {
                $model->src = $file['src'];
                $model->file_type=substr(strrchr($file['src'], '.'), 1);
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }else {
                var_dump($model->getErrors());
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing UploadFiles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated_at=time();
        if(\Yii::$app->request->isPost){
            $model->upload_file = UploadedFile::getInstance($model, 'upload_file');
            if (($file = $model->uploadFile())!=false) {
                UtilHelper::DeleteImg($model->src);
                $model->src = $file['src'];
                $model->file_type=substr(strrchr($file['src'], '.'), 1);
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }else {
                var_dump($model->getErrors());
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UploadFiles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->delete();
        UtilHelper::DeleteImg($model->src);
        return $this->redirect(['index']);
    }

    /**
     * Finds the UploadFiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UploadFiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UploadFiles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
