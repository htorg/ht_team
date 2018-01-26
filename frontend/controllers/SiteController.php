<?php
namespace frontend\controllers;

use common\models\CmsArticle;
use common\models\CmsBannerPic;
use common\models\CmsCategory;
use common\models\CmsCompanyHonor;
use common\models\CmsPageAbout;
use common\models\CmsPageContact;
use common\models\CmsProduct;
use common\models\FriendLink;
use common\models\ServicesInfo;
use common\models\UploadFiles;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use frontend\components\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\data\Pagination;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCenter()
    {
        return $this->render('center');
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = CmsPageContact::find()->where(['type'=>CmsPageContact::TYPE_COMPANY])->one();
        if (!is_object($model)){
            exit('请联系管理员添加相应信息');
        }
        $this->getView()->title='联系方式';
        $this->getView()->registerMetaTag(array("name"=>"keywords","content"=>$model->meta_keywords));
        $this->getView()->registerMetaTag(array("name"=>"description","content"=>$model->meta_description));
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $model=CmsPageAbout::find()->with(['company'])->one();
        if (!is_object($model)){
            exit('请联系管理员添加相应信息');
        }
        $this->getView()->title='公司简介';
        $this->getView()->registerMetaTag(array("name"=>"keywords","content"=>$model->meta_keywords));
        $this->getView()->registerMetaTag(array("name"=>"description","content"=>$model->meta_description));
        return $this->render('about',['model'=>$model]);
    }
    public function actionAboutPark(){
        $model=CmsCategory::find()->joinWith(['articles'])->where(['cms_category.type'=>CmsCategory::TYPE_PARK])->one();
        if (!is_object($model)){
            exit('请联系管理员添加相应信息');
        }
        $this->getView()->title=$model->name;
        $this->getView()->registerMetaTag(array("name"=>"keywords","content"=>$model->meta_keywords));
        $this->getView()->registerMetaTag(array("name"=>"description","content"=>$model->meta_description));
        return $this->render('about-park',['model'=>$model]);
    }
    public function actionHonor(){
        $model=CmsCompanyHonor::find()->one();
        if (!is_object($model)){
            exit('请联系管理员添加相应信息');
        }
        $this->getView()->title='资质荣誉';
        $this->getView()->registerMetaTag(array("name"=>"keywords","content"=>$model->meta_keywords));
        $this->getView()->registerMetaTag(array("name"=>"description","content"=>$model->meta_description));
        $model->honor_country=explode("\r\n",$model->honor_country);
        $model->honor_provice=explode("\r\n",$model->honor_provice);
        return $this->render('honor',['model'=>$model]);
    }
    public function actionProduct(){
        if (isset($_REQUEST['id'])){
            $model=CmsProduct::find()->with(['infos','pics'])->where(['cms_product.id'=>$_REQUEST['id']])->one();
        }else{
            $model=CmsProduct::find()->with(['infos','pics'])->orderBy('id asc')->one();
        }
        if (!is_object($model)){
            exit('请添加产品信息');
        }
        $this->getView()->title=CmsProduct::getProductType($model->type);
        $this->getView()->registerMetaTag(array("name"=>"keywords","content"=>$model->meta_keywords));
        $this->getView()->registerMetaTag(array("name"=>"description","content"=>$model->meta_description));
        if (!empty($model->infos)&&($model->type!=CmsProduct::TYPE_LEASE)){
            foreach ($model->infos as $info){
                $info->node_description=explode("\r\n",$info->node_description);
            }
        }
        if (!empty( $model->pics->show_pics)){
            $model->pics->show_pics=json_decode($model->pics->show_pics);
        }
        $view=CmsProduct::getView($model->type);
        //var_dump($view);die();
        //var_dump($model);
        return $this->render($view,['model'=>$model]);
    }
    public function actionOperate(){
        $this->layout='other';
        $model=CmsPageContact::find()->where(['type'=>CmsPageContact::TYPE_PROPERTY])->one();
        $infos=ServicesInfo::find()->one();
        $infos->banner_files=json_decode($infos->banner_files);
        $infos->platform_config1=explode('#',$infos->platform_config1);
        $infos->platform_config2=explode('#',$infos->platform_config2);
        $infos->platform_config3=explode('#',$infos->platform_config3);
        $articles=CmsCategory::find()->joinWith(['articles'])->where(['cms_category.type'=>CmsCategory::TYPE_OPERATE])->one();

        return $this->render('operate',['model'=>$model,'infos'=>$infos,'articles'=>$articles]);
    }

    public function actionSettled(){
        $model=ServicesInfo::find()->one();
        $files=UploadFiles::find()->all();
        return $this->render('settled',['model'=>$model,'files'=>$files]);
    }

    public function actionList(){
        //获取当前栏目
       $query=CmsCategory::find()->where(['type'=>CmsCategory::TYPE_NEWS]);
       $category_list=$query->all();
        if (isset($_REQUEST['id'])){
            $query=$query->andWhere(['id'=>$_REQUEST['id']]);
        }
        $category=$query->one();
        if (!is_object($category)){
            exit('请添加新闻栏目');
        }
        $this->getView()->title=$category->name;
        $this->getView()->registerMetaTag(array("name"=>"keywords","content"=>$category->meta_keywords));
        $this->getView()->registerMetaTag(array("name"=>"description","content"=>$category->meta_description));
        $query=CmsArticle::find()->where(['category_id'=>$category->id]);
        $count=$query->count();
        $page=\Yii::$app->request->get('page',1);
        $pageSize=10;
        $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => $pageSize]);
        $list=$query->offset(($page-1)*$pageSize)->limit($pageSize)->asArray()->all();
        $recommon_list=CmsArticle::find()->joinWith(['category'])->where(['cms_category.type'=>CmsCategory::TYPE_NEWS,'cms_article.type'=>CmsArticle::TYPE_RECOMAND])->all();
        //var_dump($recommon_list);
        return $this->render('list',[
            'model'=>$category,
            'category_list'=>$category_list,
            'list'=>$list,
            'pagination'=>$pagination,
            'recommon_list'=>$recommon_list]);
    }
    public function actionNew()
    {
        $id = Yii::$app->request->get('id', false);
        if ($id === false) {
            exit('缺少必要的参数');
        }
        $news = CmsArticle::findOne(['id' => $id]);
        if (!is_object($news)) {
            exit('新闻不存在');
        }
        $this->getView()->title = $news->name;
        $this->getView()->registerMetaTag(array("name" => "keywords", "content" => $news->meta_keywords));
        $this->getView()->registerMetaTag(array("name" => "description", "content" => $news->meta_description));
        $news->view_count++;
        $news->save();
        $sufNewsId = CmsArticle::find()->where(['>', 'id', $id])->min('id');
        $sufNews = [];
        if (!empty($sufNewsId)) {
            $sufNews = CmsArticle::findOne($sufNewsId);
        }
        $recommon_list = CmsArticle::find()->joinWith(['category'])->where(['cms_category.type' => CmsCategory::TYPE_NEWS, 'cms_article.type' => CmsArticle::TYPE_RECOMAND])->all();
        $this->getView()->title = $news->name . ' - 文章资讯详情';
        return $this->render('news-page', [
            'news' => $news,
            'sufNews' => $sufNews,
            'recommon_list' => $recommon_list
        ]);
    }

    public function actionJoin(){
        $query=FriendLink::find();
        $count=$query->count();
        $page=\Yii::$app->request->get('page',1);
        $pageSize=36;
        $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => $pageSize]);
        $list=$query->offset(($page-1)*$pageSize)->limit($pageSize)->asArray()->all();
        return $this->render('join',[
            'list'=>$list,
            'pagination'=>$pagination]);
    }
}
