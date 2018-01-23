<?php
namespace frontend\controllers;

use frontend\components\Controller;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use common\models\CmsBanner;
use common\models\CmsCase;
use common\models\CmsPageAbout;
use common\models\CmsPageContact;
use common\models\CmsArticle;
use common\models\CmsCaseCategory;
use yii\data\Pagination;
use common\models\CmsService;
use common\models\CmsCategory;
use common\models\CmsPage;
use common\models\CmsAlbum;
use common\models\CmsTopBanner;
use common\models\CmsCaseConfig;
use common\models\CmsProductCategory;
use common\models\CmsProductInfo;
use common\helpers\ProductHelper;
use common\models\CmsProductInquiry;
use common\helpers\ThemeHelper;

use common\models\FriendLink;

use common\models\CmsFreecate;
use common\models\CmsJoinInfo;

use common\models\CmsProblem;
use common\models\CmsBrand;
use common\models\CmsBrandCategory;
use common\helpers\InitHelper;
use common\helpers\ExchangeHelper;
use console\controllers\ExchangeController;
use common\models\CmsExchange;
use yii\base\Object;
use common\helpers\UtilHelper;
use common\models\GhSite;
use common\models\CmsAboutTeam;
use common\helpers\DataHelper;
use common\models\TkTotal;
use common\models\TkClassInfo;
use common\helpers\SiteHelper;
use common\models\CmsIndexConfig;
use common\models\CmsConfigType;
use common\models\CmsNav;
use common\helpers\CategoryHelper;
use frontend\helpers\ChatHelper;
use yii\helpers\VarDumper;
use Codeception\Module;
use common\models\CmsUploadFile;
use common\models\CmsRecruitment;
use common\models\CmsResume;
use common\models\Province;
use common\models\City;
use common\models\DokeEthnic;
use common\models\CmsWorkExperience;
use common\models\CmsEduExperience;
use common\models\CmsProductSku;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $pageType = 1;
    public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
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
        $this->getView()->title = '首页';
        $where = [
            'site_id' => $this->siteId,
            'lang_id' => $this->langId,
            'status' => 10,
        ];
        //获取首页配置信息
    	$features=ThemeHelper::getFeaturesById($this->themeId);
        //获取配置项
        $config_info=ThemeHelper::getConfigType();
        //获取每一个feature对应的配置项
        $configs=[];
        foreach ($features as $val){
        	foreach ($config_info as $key=>$info){
        		if(in_array($val, $info['feature'])){
        			//$info['value']=CmsIndexConfig::find()->where(['config_id'=>$info['id'],'feature'=>$val])->asArray()->one();
        			$info['model']=CmsIndexConfig::find()->where(['config_id'=>$info['id'],'feature'=>$val,'site_id'=>$this->siteId,'lang_id'=>$this->langId])->one();
        			$configs[$val][$info['code']]=$info['model']['value'];	
        		}
        	}
        }
		//承载首页参数集
		$params=[];
        foreach ($features as $feature){
        	switch ($feature){
        		case ThemeHelper::$THEME_FEATURE_BANNER:
        			if(isset($configs[$feature])){
        				$params['banners_config']=$configs[$feature];
        			}       			
        			$banners['homepage'] = CmsBanner::find()->with('images')->where($where)->andWhere(['like','pos',',homepage,'])->orderBy('sort_val asc')->asArray()->one();
        			$banners['home_value'] = CmsBanner::find()->with('images')->where($where)->andWhere(['like','pos',',home_value,'])->orderBy('sort_val asc')->asArray()->one();       			 
        			if(count($banners)==1){
        				$banners=$banners[0];
        			}
        			$params['banners']=$banners;
        			break;
        		case ThemeHelper::$THEME_FEATURE_SERVICE:
        			$query=CmsService::find()->where($where);
        			if(isset($configs[$feature])){
        				$params['services_config']=$configs[$feature];
        				if(isset($configs[$feature]['homepage_count'])){
        					$query->limit($configs[$feature]['homepage_count']);
        				}
        			}      			        			
        			$params['services']=$query->orderBy('sort_val asc')->asArray()->all();
        			break;
        		case ThemeHelper::$THEME_FEATURE_CASE:
        			$query=CmsCase::find()->where($where);
        			if(isset($configs[$feature])){
        				$params['cases_config']=$configs[$feature];
        				if(isset($configs[$feature]['homepage_count'])){
        					$query->limit($configs[$feature]['homepage_count']);
        				}
        			}
        			$params['cases']=$query->asArray()->all();
        			$params['cases_cate']=CmsCaseCategory::find()->where($where)->andWhere(['parent_id'=>0])->asArray()->all();
        			break;
        		case ThemeHelper::$THEME_FEATURE_PRODUCT:
        			if(isset($configs[$feature])){
        				$params['products_config']=$configs[$feature];
        			}
        			$productConfig = ProductHelper::getProductConfigCache($this->siteId, $this->langId);
        			$product_cate=CmsProductCategory::find()->where($where)->limit(5)->asArray()->all();
        			$query=CmsProductInfo::find()->where($where);
        			if(isset($configs[$feature]['homepage_count'])){
        				$query->limit($configs[$feature]['homepage_count']);
        			}
        			$params['products']=$query->orderBy('recommend desc,sort_val asc')->asArray()->all();
        			$params['product_cate']=$product_cate;
        			$params['productConfig']=$productConfig;
        			break;
        		case ThemeHelper::$THEME_FEATURE_ARTICLE:
        			if(isset($configs[$feature])){
        				$params['articles_config']=$configs[$feature];
        			}
        			//DataHelper::getNewArtical($lenght, $where);
        			if(isset($configs[$feature]['homepage_cate'])){
        				if(isset($configs[$feature]['homepage_count'])){
        					$params['articles']=DataHelper::getCateArticle($configs[$feature]['homepage_cate'], $where,$configs[$feature]['homepage_count']);
        				}else{
        					$params['articles']=DataHelper::getCateArticle($configs[$feature]['homepage_cate'], $where);
        				}	
        			}else{
        				$query=CmsCategory::find()->where($where)->andWhere(['type'=>'news'])->andwhere('parent_id>0');
        				$cate_id=\Yii::$app->request->get('cid','');
        				if(!empty($cate_id)){
        					$query->andwhere(['category_id'=>$cid]);
        				}
        				$categorys = $query->asArray()->all();
        				$articles = [];
        				if(!empty($categorys)){
        					foreach ($categorys as $category){
        						$article=CmsArticle::find()->where($where)->andWhere(['category_id'=>$category['id']])->asArray()->all();
        						foreach ($article as $val){
        							array_push($articles,$val);
        						}
        					}
        				}
        				if(isset($configs[$feature]['homepage_count'])){
        					if(count($articles)>$configs[$feature]['homepage_count']){
        						$articles= array_slice($articles,0,$configs[$feature]['homepage_count']-1);
        					}
        				}
        				$params['articles_categorys']=$categorys;
        				$params['articles']=$articles;
        			}        			
        			break;
        		case ThemeHelper::$THEME_FEATURE_PAGE_ABOUT:
        			if(isset($configs[$feature])){
        				$params['about_config']=$configs[$feature];
        			}
        			if(isset($configs[$feature]['homepage_count'])){
        				$about = CmsPageAbout::find()->with(['teams'])->where($where)->limit($configs[$feature]['homepage_count'])->asArray()->one();
        			}else{
        				$about = CmsPageAbout::find()->with(['teams'])->where($where)->asArray()->one();
        			}
        			$params['about']=$about;
        			break;
        		case ThemeHelper::$THEME_FEATURE_FRIENDLINK:
        				if(isset($configs[$feature])){
        					$params['partner_config']=$configs[$feature];
        				}
        		break;
        		case ThemeHelper::$THEME_FEATURE_JOININFO:
        				if(isset($configs[$feature])){
        					$params['joininfo_config']=$configs[$feature];
        				}
        				if(isset($configs[$feature]['homepage_count'])){
        					$joininfos = CmsJoinInfo::find()->where($where)->limit($configs[$feature]['homepage_count'])->asArray()->all();
        				}else{
        					$joininfos = CmsJoinInfo::find()->where($where)->asArray()->all();
        				}
        			$params['joininfos']=$joininfos;	
        		break;
        		default:
        			if(isset($configs[$feature])){
        				$params['freeCate_config']=$configs[$feature];
        			}
        			$freeCate=[];
        			$category_free = CmsCategory::find()->where($where)->andWhere(['type'=>'freecate'])->one();
        			if(is_object($category_free)){
        				$freeCate=CmsArticle::find()->where($where)->andWhere(['category_id'=>$category_free->id])->orderBy('sort_val asc')->limit(2)->asArray()->all();
        			}
        			$params['freeCate']=$freeCate;
        			break;        			
        	}	
        }    
        $params['pro_pics']=CmsBanner::find()->with('images')->where($where)->andWhere(['like','pos',',homepro,'])->orderBy('sort_val asc')->asArray()->one();
        $params['mainDatas']=$this->mainDatas;
        //var_dump($params);die();
        return $this->render('index', $params);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->getView()->title = '登录';
        
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        ThemeHelper::frontendCheckAccess('page-about',$this->siteId);
        $this->getView()->title = '关于我们';
        $where = [
            'site_id' => $this->siteId,
            'lang_id' => $this->langId,
            'status' => 10,
        ];
        $params['about'] = CmsPageAbout::find()->with(['teams','events'])->where($where)->asArray()->one();
        $params['about_list']=CmsPage::find()->where($where)->andWhere(['parent_id'=>0,'type'=>CmsPage::TYPE_ABOUT])->asArray()->all();
        $params['change_list']=CmsPage::find()->where($where)->andWhere(['parent_id'=>0,'type'=>CmsPage::TYPE_CHANGE])->asArray()->all();
        return $this->render('about-us-page',$params);
    }
    public function actionAboutFunture(){
    	ThemeHelper::frontendCheckAccess('page-about',$this->siteId);
    	$where = [
    			'site_id' => $this->siteId,
    			'lang_id' => $this->langId,
    			'status' => 10,
    	];
    	$funtures=CmsCategory::find()->with(['indexArticles'])->where($where)->andWhere(['type'=>CmsCategory::CATE_ABOUT])->one();
    	if (is_object($funtures)){
    		$this->getView()->title = $funtures->name;
    	}else{
    		$this->getView()->title ='医点未来';
    	}
    	return $this->render('about-funture',['funtures'=>$funtures]);
    }
    public function actionAboutPartner(){
    	ThemeHelper::frontendCheckAccess('page-about',$this->siteId);
    	$where = [
    			'site_id' => $this->siteId,
    			'lang_id' => $this->langId,
    	];
    	$partners=FriendLink::find()->where($where)->asArray()->all();
    	$this->getView()->title = '合作伙伴';
    	return $this->render('about-partner',['partners'=>$partners]);
    }
    public function actionAboutOrgan(){
    	ThemeHelper::frontendCheckAccess('page-about',$this->siteId);
    	$where = [
    			'site_id' => $this->siteId,
    			'lang_id' => $this->langId,
    	];
    	$organ=CmsPageAbout::find()->select('banner')->where($where)->asArray()->one();
    	$this->getView()->title = '组织架构';
    	return $this->render('about-organ',['organ'=>$organ]);
    }
	public function actionTeam(){

		$this->getView()->title = '关于我们';
		$where = [
				'site_id' => $this->siteId,
				'lang_id' => $this->langId,
				'status' => 10,
		];		
		$about = CmsPageAbout::find()->with(['teams','events'])->where($where)->asArray()->one();
		$about_list = CmsPage::find()->where($where)->andWhere( ['parent_id' => 0])->asArray()->all();
		$recommend=DataHelper::getRecommend(10, $where);
		return $this->render('about-team', [
				'teams'=>$about['teams'],
				'about_list'=>$about_list,
				'recommend'=>$recommend
		]);
	}
    public function actionContact()
    {
        ThemeHelper::frontendCheckAccess('page-contact',$this->siteId);
        $this->getView()->title = '联系我们';
        $where = [
            'site_id' => $this->siteId,
            'lang_id' => $this->langId,
            'status' => 10,
        ];
		$params['contacts']=CmsPageContact::find()->where($where)->asArray()->all();
        return $this->render('contact-us-page',$params);
    }

	public function actionUpload(){
		$this->getView()->title = 'App下载';		
		$where = [
				'site_id' => $this->siteId,
				'lang_id' => $this->langId,
				'status' => 10,
		];
		$id = Yii::$app->request->get('id', false);
		if ($id==false){
			exit('参数错误');
		}
		$model=CmsProductCategory::findOne($id);
		return $this->render('upload',['model'=>$model]);
	}	
	public function actionQuestion(){
		ThemeHelper::frontendCheckAccess('question',$this->siteId);
		$this->getView()->title = '常见问题';
		$where = [
				'site_id' => $this->siteId,
				'lang_id' => $this->langId,
				'status' => 10,
		];
		$question=CmsCategory::find()->with(['indexArticles'])->where($where)->andWhere(['type'=>CmsCategory::CATE_QUESTION])->asArray()->one();
		return $this->render('question',['question'=>$question]);
	}
	
	
    public function actionSinglePage()
    {    	
        ThemeHelper::frontendCheckAccess('page',$this->siteId);
        $id = Yii::$app->request->get('id', false);
        if( $id===false ){
            exit('缺少必要的参数');
        }
        $model = CmsPage::findOne(['id' => $id, 'status' => 10]);
        $this->getView()->title = $model->name;
        if( !is_object($model)&&$model->type!=CmsPage::TYPE_ABOUT ){
            exit('案例不存在');
        }                
        return $this->render('single-page', ['model' => $model]);
    }
    public function actionSinglePage1()
    {
    	
    	ThemeHelper::frontendCheckAccess('page',$this->siteId);
    	$id = Yii::$app->request->get('id', false);
    	if( $id===false ){
    		exit('缺少必要的参数');
    	}
    	$model = CmsPage::findOne(['id' => $id, 'status' => 10]);
    	$this->getView()->title = $model->name;
    	if( !is_object($model)&&$model->type!=CmsPage::TYPE_CHANGE ){
    		exit('案例不存在');
    	}
    	$params=[];
    	$params['model']=$model;
    	$where = [
    			'site_id' => $this->siteId,
    			'lang_id' => $this->langId,
    			'status' => 10,
    	];
    	if($this->mainDatas['cmsSite']['theme_id']==11){
    		$params['team_leader']=CmsAboutTeam::find()->where($where)->andWhere(['sort_val'=>1])->one();
    		if(!is_object($params['team_leader'])){
    			exit('请添加团队领导信息');
    		}
    	}
    	return $this->render('single-page1',$params);
    }
    public function actionSinglePage2()
    {
    	ThemeHelper::frontendCheckAccess('page',$this->siteId);
    	$id = Yii::$app->request->get('id', false);
    	if( $id===false ){
    		exit('缺少必要的参数');
    	}    
    	$model = CmsPage::findOne(['id' => $id, 'status' => 10]);
    	if( !is_object($model)&&$model->type!=CmsPage::TYPE_EXAMPLE ){
    		exit('案例不存在');
    	}
    	$this->getView()->title = $model->name;
    	$where = [
    			'site_id' => $this->siteId,
    			'lang_id' => $this->langId,
    			'status' => 10,
    	];
    	$about_left_pic=CmsPageAbout::find()->select('homepage_left_pic')->where($where)->one();
    	$params=[];
    	$params['model']=$model;
    	$params['left_pic']=$about_left_pic['homepage_left_pic'];
    	return $this->render('single-page2', $params);
    }
    public function actionSinglePage3()
    {
    	ThemeHelper::frontendCheckAccess('page',$this->siteId);
    	$id = Yii::$app->request->get('id', false);
    	if( $id===false ){
    		exit('缺少必要的参数');
    	}   
    	$model = CmsPage::findOne(['id' => $id, 'status' => 10]);
    	$this->getView()->title = $model->name;
    	if( !is_object($model)&&$model->type!=CmsPage::TYPE_NEWS ){
    		exit('案例不存在');
    	}
    	$params=[];
    	$params['model']=$model;
    	$where = [
    			'site_id' => $this->siteId,
    			'lang_id' => $this->langId,
    			'status' => 10,
    	];
    	$teams=CmsAboutTeam::find()->where($where)->asArray()->all();
    	$params['teams']=$teams;
    	if($this->mainDatas['cmsSite']['theme_id']==12){
    		$params['uploads']=CmsUploadFile::find()->where($where)->asArray()->all();
    	}
    	return $this->render('single-page3',$params);
    }

    public function actionAlbum()
    {
        ThemeHelper::frontendCheckAccess('cms-album',$this->siteId);
        
        $aid = Yii::$app->request->get('aid', 0);
    
        $where = [
            'id' => $aid,
            'site_id' => $this->siteId,
            'lang_id' => $this->langId,
            'status' => 10,
        ];
        
        $album = CmsAlbum::find()->with(['pics'])->where($where)->one();
        
        unset($where['id']);
        $where['pos'] = 'album';
        $topBanner = CmsTopBanner::find()->where($where)->one();
        
        $this->getView()->title = $album->name . ' - 图册';;
        
        return $this->render('album', [
            'album' => $album,
            'topBanner' => $topBanner,
        ]);
    }
    


    public function actionAlbumList()
    {
        ThemeHelper::frontendCheckAccess('cms-album',$this->siteId);
        $page = Yii::$app->request->get('page', 1);
        $pageSize = 24;    
        $where = [
            'site_id' => $this->siteId,
            'lang_id' => $this->langId,
            'status' => 10,
        ];
    
        $count = CmsAlbum::find()->where($where)->count();
        $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => $pageSize]);
    
        $page = ($tmp=intval($page))==0? 1:$tmp;
        $albums = CmsAlbum::find()->where($where)->offset(($page-1)*$pageSize)->limit($pageSize)->asArray()->all();
        
        $where['pos'] = 'album';
        $topBanner = CmsTopBanner::find()->where($where)->one();
        
        $this->getView()->title = '图册列表';;
    
        return $this->render('album-list', [
            'albums' => $albums,
            'pagination' => $pagination,
            'topBanner' => $topBanner,
        ]);
    }

    public function actionList()
    {    	   	
    	$this->getView()->title = '文章资讯列表';
        $where = [
            'site_id' => $this->siteId,
            'lang_id' => $this->langId,
            'status' => 10,
        ];
        $cate=CmsCategory::find()->where($where)->andWhere(['type'=>CmsCategory::CATE_NEWS])->one();
        if (!is_object($cate)){
        	exit('暂无动态');
        }
        $banners=CmsBanner::find()->with('images')->where($where)->andWhere(['like','pos',',news,'])->orderBy('sort_val asc')->asArray()->one();        
        $where['category_id']=$cate->id;
        $query=CmsArticle::find()->where($where);
        $list=$query->asArray()->all();
        $dataList=CmsArticle::find()->select('dateline')->distinct()->asArray()->all();
        $page=\Yii::$app->request->get('page',1);
        $pageSize = 6;
        $query=CmsArticle::find()->where($where);
        if (isset($_GET['time'])){
        	$query->andwhere(['dateline'=>$_GET['time']]);
        }
        $count = $query->count();
        $list = $query->offset(($page-1)*$pageSize)->limit($pageSize)->asArray()->all();       
        $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => $pageSize]);
        //var_dump($dataList);
        return $this->render('list-page', [
        	'list' => $list,
            'datalist' => $dataList,
            'pagination' =>$pagination,
        	'banners'=>$banners	
        ]);
    }

    public function actionNews()
    {
        //echo SiteHelper::getCurrentSiteId();
        $id = Yii::$app->request->get('id', false);
        $where = [
        		'site_id' => $this->siteId,
        		'lang_id' => $this->langId,
        		'status' => 10,
        ];
        if( $id===false ){
            exit('缺少必要的参数');
        }
        $news = CmsArticle::findOne(['id' => $id, 'status' => 10]);
        if( !is_object($news) ){
            exit('新闻不存在');
        }

        $news->view_count++;
        $news->save();
        
        $where = [
            'site_id' => $this->siteId,
            'lang_id' => $this->langId,
            'status' => 10,
        ]; 
        $newList=DataHelper::getNewArtical(10, $where);
        $categoryList =CmsCategory::find()->where($where)->andWhere(['type'=>CmsCategory::CATE_NEWS])->andWhere( ['not', ['parent_id' => 0]])->asArray()->all();       
        $preNewsId = CmsArticle::find()->where(['<', 'id', $id])->andWhere($where)->andWhere(['category_id'=>$news->category_id])->max('id');
        $sufNewsId = CmsArticle::find()->where(['>', 'id', $id])->andWhere($where)->andWhere(['category_id'=>$news->category_id])->min('id');

        $preNews = [];
        $sufNews = [];
        if( !empty($preNewsId) ){
            $preNews = CmsArticle::findOne($preNewsId);
        }
        if( !empty($sufNewsId) ){
            $sufNews = CmsArticle::findOne($sufNewsId);
        }        
        $where['category_id'] = $news->category_id;
        $where['recommend'] = 1;
        //$recommendList = CmsArticle::find()->where($where)->andWhere('id!=:id',[':id'=>$id])->asArray()->all();       
        $category = '';
        if (!empty($news->category_id))
        {
            $category = CmsCategory::findOne($news->category_id);
        }
        $this->getView()->title = $news->name . ' - 文章资讯详情';
       
        return $this->render('news-page', [
                'news' => $news, 'category'=>$category, 
                'preNews' => $preNews, 'sufNews' => $sufNews,
        ]);
    }
    
    public function actionProducts()
    {
        ThemeHelper::frontendCheckAccess('cms-product',$this->siteId);        
        $cid = Yii::$app->request->get('cid', '');
        $where = [
            'site_id' => $this->siteId,
            'lang_id' => $this->langId,
            'status' => 10,
        ];     
        $andWhere = [];
        if(empty($cid) ){
        	$cid=CmsProductCategory::find()->where($where)->asArray()->one()['id'];   	        	
        }
        $andWhere['category_id']=$cid;
        $model=CmsProductCategory::findOne($cid);
        $model->description=explode('#', $model->description);
        $products = CmsProductInfo::find()->where($where)->andWhere($andWhere)->asArray()->all();
        foreach ($products as $key=>$val){
        	$products[$key]['desclist']=explode('#', json_decode($val['product_info'])->description);
        	$products[$key]['skus'] = CmsProductSku::find()->with(['pics'])->where(['product_id'=>$val['id']])->asArray()->all();
        }
       
        if (is_object($model)){
        	$this->getView()->title=$model->name;
        }
    	switch ($model->parent_id){
    		case 0://LB01
			return $this->render('products', [	'products' => $products,'model'=>$model]);
			break;
			case 1://lb02
			return $this->render('products1', [	'products' => $products,'model'=>$model]);
    	}
        
    }
    
    public function actionProduct()
    {
        ThemeHelper::frontendCheckAccess('cms-product',$this->siteId);
        $id = Yii::$app->request->get('id', false);
        if( $id===false ){
            exit('缺少必要的参数');
        }
        $where = [
        		'site_id' => $this->siteId,
        		'lang_id' => $this->langId,
        		'status' => 10,
        ];
        $cts = [];
        $cts = CmsProductCategory::find()->where($where)->andWhere(['parent_id' => 0])->asArray()->all();
        $model = ProductHelper::getProductCache($id);
    	$model['product_info']=json_decode($model['product_info'],true);
        $productConfig = ProductHelper::getProductConfigCache($this->siteId, $this->langId);
    
        $this->getView()->title = $model['product_name'] . ' - 商品详情';
        
        $recommendList = ProductHelper::getProductRecommendCache($this->siteId, $this->langId);
        $contact = CmsPageContact::find()->where($where)->asArray()->one();
        $web=GhSite::find()->select(['host_name'])->where(['id'=>$this->siteId])->asArray()->one();
        return $this->render('product', [
        		'model' => $model, 
        		'productConfig' => $productConfig, 
        		'recommendList'=>$recommendList,
        		'cts'=>$cts,
        		'contact'=>$contact,
        		'web'=>$web
        		]);
    }
    public function actionFriend(){
    	ThemeHelper::frontendCheckAccess('friendlink',$this->siteId);
    	$where=[
    		'site_id'=>$this->siteId,
    		'lang_id'=>$this->langId,	
    	];
    	$friend_types=FriendLink::find()->select('type')->distinct()->where($where)->asArray()->all();
    	$type=\Yii::$app->request->get('type','');
    	if(!empty($type)){
    		$where['type']=$type;
    	}
    	$friend_links=FriendLink::find()->where($where)->asArray()->all();    	
    	$this->getView()->title = '合作伙伴';
    	return $this->render('friend',['friend_links'=>$friend_links,'friend_types'=>$friend_types]);
    }
    public function actionProductSubmit()
    {
    	if(isset($_POST['type'])&&$_POST['type']==12){
    		if(empty($_POST['info']['mail'])){
    			$result=['c'=>0,'msg'=>'信息填写不完整'];
    		}
    		$productConfig = ProductHelper::getProductConfigCache($this->siteId, $this->langId);
    		$address=isset($productConfig['inquiry_email'])?$productConfig['inquiry_email']:'513624146@qq.com';
    		$mail=Yii::$app->mailer->compose('join-info', [
    				'info' =>$_POST['info']]
    		);
    		
			$mail->setFrom('cs@gohoc.com');
			
    		$mail->setTo($address);
    		
    		$mail->setSubject('您收到了一个新的询单');
    		
    		if($mail->send()){
    			$result=['c'=>1,'msg'=>'发送成功:'.$address];
    		}else{
    			$result=['c'=>2,'msg'=>'发送失败:'.$address];
    		}
    		return json_encode($result);
    	}
        ThemeHelper::frontendCheckAccess('cms-product',$this->siteId);
        $id = Yii::$app->request->post('product_id', false);
        if( $id===false ){
            exit('缺少必要的参数');
        }
        $inquiry = Yii::$app->request->post('inquiry', '');
    
        if (empty($inquiry))
        {
            exit('缺少必要的参数');
        }
        
        $model = new CmsProductInquiry();
        $model->lang_id = $this->langId;
        $model->site_id = $this->siteId;
        $model->product_id = $id;
        $model->inquiry_detail = json_encode($inquiry);      
        if ($model->save())
        {
			$productConfig = ProductHelper::getProductConfigCache($this->siteId, $this->langId);
			
			Yii::$app->mailer->compose('product-order', [
				'product' => ProductHelper::getProductCache($id),
				'inquiry_detail' => $inquiry]
			)
			->setFrom('cs@gohoc.com')
			->setTo($productConfig['inquiry_email'])
			->setSubject('您收到了一个新的询单')
			->send();
            return $this->redirect(['site/product','id'=>$id]);
        }
        else
        {
            print_r($model->firstErrors);
            exit();
        }
    }
    public function actionSetlang(){
    	$rt=[];
		if(isset($_POST['lang'])){
			$lang=$_POST['lang'];
			if($lang=='简体中文'){
				$_SESSION['lang']='zh-CN';
				$_SESSION['lang_id']=1;
			}else if($lang=='ENG'){
				$_SESSION['lang']='en-us';
				$_SESSION['lang_id']=2;
			}else if($lang=='日语'){
				$_SESSION['lang']='ja-JP';
				$_SESSION['lang_id']=3;
			}
			$rt = ['c'=>0,'msg'=>'修改成功'];
		}else{
			$rt = ['c'=>1,'msg'=>'修改失败'];
		}
		return json_encode($rt);
    }
	public function actionSignCaptcha()
	{
		$session = Yii::$app->session;
		$session->set('sign-captcha',UtilHelper::captcha());
		return UtilHelper::captcha();
	}
	public function actionInfo(){
		$name=\Yii::$app->request->post('name','');
		$phone=\Yii::$app->request->post('phone','');
		$mail=\Yii::$app->request->post('mail','');
		$txt=\Yii::$app->request->post('txt','');
		$cap=\Yii::$app->request->post('cap','');
		$session = Yii::$app->session;
		if (empty($name) || empty($phone))
		{
			return json_encode(['c'=>0,'msg'=>'请完善加盟信息']);
		}
		if ($session->has('sign-captcha'))
		{
			if ($session->get('sign-captcha') != md5($_POST['cap']))
			{
				return json_encode(['c'=>-1,'msg'=>'验证码不正确']);
			}
		}
		$joinInfo=new CmsJoinInfo();
		$joinInfo->name=$name;
		$joinInfo->phone=$phone;
		$joinInfo->mail=$mail;
		$joinInfo->content=$txt;
		$joinInfo->site_id=$this->siteId;
		$joinInfo->lang_id=$this->langId;
		$joinInfo->created_at=time();
		if ($joinInfo->insert()){  
            return json_encode(['c'=>1,'msg'=>'信息提交成功']);
        }else{
            return json_encode(['c'=>2,'msg'=>'提交失败，请重试']);
        }
	}


}
