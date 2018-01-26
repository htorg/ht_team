<?php

namespace backend\controllers;

use common\models\CmsPageAbout;
use Yii;
use common\models\CmsPageContact;
use common\models\searchs\CmsPageContactSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CmsPageContactController implements the CRUD actions for CmsPageContact model.
 */
class CmsPageContactController extends Controller
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
     * Lists all CmsPageContact models.
     * @return mixed
     */
    public function actionIndex()
    {
        $type=Yii::$app->request->get('type',CmsPageContact::TYPE_COMPANY);
        $model = CmsPageContact::find()->where(['type'=>$type])->one();
        if (is_object($model))
        {
            return $this->redirect(['cms-page-contact/update','id'=>$model->id]);
        }
        else
        {
            return $this->redirect(['cms-page-contact/create','type'=>$type]);
        }
    }

    /**
     * Displays a single CmsPageContact model.
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
     * Creates a new CmsPageContact model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $type=Yii::$app->request->get('type',CmsPageContact::TYPE_COMPANY);
        $model = CmsPageContact::find()->where(['type'=>$type])->one();
        if (is_object($model))
        {
            return $this->redirect(['cms-page-contact/update','id'=>$model->id]);
        }
        $model = new CmsPageContact();
        $model->type=$type;
        $model->created_at=time();
        $model->updated_at=time();
        if (Yii::$app->request->isPost){
            $model->upload_banner=UploadedFile::getInstance($model, 'upload_banner');
            if (($file = $model->uploadBanner())!=false) {

                $model->banner = $file['src'];
            }
            $model->upload_weixin=UploadedFile::getInstance($model, 'upload_weixin');
            if (($file = $model->uploadWeixin())!=false) {
                $model->wxopenid = $file['src'];
            }
            $model->upload_weibo=UploadedFile::getInstance($model, 'upload_weibo');
            if (($file = $model->uploadWeibo())!=false) {
                $model->qq = $file['src'];
            }
            $model->upload_map=UploadedFile::getInstance($model, 'upload_map');
            if (($file = $model->uploadMap())!=false) {
                $model->map_img = $file['src'];
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['update', 'id' => $model->id]);
            }else{
                var_dump($model->getErrors());
            }
        }
        return $this->render('create', [
            'model' => $model,
            'type'=>$type
        ]);
    }

    /**
     * Updates an existing CmsPageContact model.
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
            $model->upload_weixin=UploadedFile::getInstance($model, 'upload_weixin');
            if (($file = $model->uploadWeixin())!=false) {
                $model->wxopenid = $file['src'];
            }
            $model->upload_weibo=UploadedFile::getInstance($model, 'upload_weibo');
            if (($file = $model->uploadWeibo())!=false) {
                $model->qq = $file['src'];
            }
            $model->upload_map=UploadedFile::getInstance($model, 'upload_map');
            if (($file = $model->uploadMap())!=false) {
                $model->map_img = $file['src'];
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['update', 'id' => $model->id]);
            }else{
                var_dump($model->getErrors());
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CmsPageContact model.
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
     * Finds the CmsPageContact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmsPageContact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsPageContact::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
