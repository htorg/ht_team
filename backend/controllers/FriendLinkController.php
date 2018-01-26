<?php

namespace backend\controllers;

use common\helpers\DataHelper;
use Yii;
use common\models\FriendLink;
use common\models\searchs\FriendLinkSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use common\helpers\UtilHelper;


/**
 * FriendLinkController implements the CRUD actions for FriendLink model.
 */
class FriendLinkController extends Controller
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
                        'actions' => ['index','view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all FriendLink models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FriendLinkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FriendLink model.
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
     * Creates a new Friendlink model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Friendlink();
        $model->created_at=time();
        $model->updated_at=time();
        if (Yii::$app->request->isPost) {
            $model->upload_logo = UploadedFile::getInstance($model, 'upload_logo');
            if (($file = $model->uploadLogo())!=false) {
                $model->logo = $file['src'];
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->redirect(['index']);
            }else{
                var_dump($model->getErrors());die();
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        return $this->render('create', [
                'model' => $model,
            ]);
        
    }

    /**
     * Updates an existing FriendLink model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated_at=time();
        if (Yii::$app->request->isPost) {
            $model->upload_logo = UploadedFile::getInstance($model, 'upload_logo');
            if (($file = $model->uploadLogo())!=false) {
                UtilHelper::DeleteImg($model->logo);
                $model->logo = $file['src'];
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->redirect(['index']);
            }else{
                var_dump($model->getErrors());die();
            }

        }
        return $this->render('create', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing FriendLink model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        UtilHelper::DeleteImg($model->logo);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FriendLink model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FriendLink the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FriendLink::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
