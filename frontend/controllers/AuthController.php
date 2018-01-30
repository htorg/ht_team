<?php
namespace frontend\controllers;

use common\helpers\UtilHelper;
use frontend\models\SetPasswordForm;
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
use common\models\User;
use yii\web\UploadedFile;


class AuthController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','center','info','login-sec','address','trade'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','center','info','login-sec','address','trade'],
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

    public function actionLogin()
    {
        $this->layout='login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        $model->username = $_POST['username'];
        $model->password = $_POST['password'];
        if ( $model->login()) {
            $rt=['c'=>0,'msg'=>'登录成功'];
            return json_encode($rt);
        } else {
            $rt=['c'=>-1,'msg'=>'用户名或者密码错误'];
            return json_encode($rt);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionGetCmscode(){
        if (!isset($_POST['phone'])) {
            $rt = ['c'=>-1,'msg'=>'手机号码不能为空'];
            return json_encode($rt);
        }
        $user = User::findByUsername($_POST['phone']);
        if (is_object($user)){
            $rt = ['c'=>-3,'msg'=>'手机号码已注册'];
            return json_encode($rt);
        }
        $cache = Yii::$app->cache;
        if (!$cache->exists('registerCode_'.$_POST['phone']))
        {
            $code = UtilHelper::getSendCode();
            $cache->set('registerCode_'.$_POST['phone'], $code, 60);
            $cache->set('registerCodeTime_'.$_POST['phone'], time(), 60);
            $rt = ['c'=>0,'msg'=>'验证码已经发送到您的手机上了：'.$code];
            /*$result=smsSendHelper::smsSender($code, $_POST['phone']);
            if($result['result']==0){
                $cache->set('registerCode_'.$_POST['phone'], $code, 600);
                $cache->set('registerCodeTime_'.$_POST['phone'], time(), 60);
                $rt = ['c'=>0,'msg'=>'验证码已经发送到您的手机上了'];
            }else{
                $rt = ['c'=>0,'msg'=>'验证码发送失败'];
            }*/
        }
        else
        {
            $code = $cache->get('registerCode_'.$_POST['phone']);
            $leftTime = 60 - (time()-$cache->get('registerCodeTime_'.$_POST['phone']));
            $rt = ['c'=>-2,'code'=>$code,'leftTime'=>$leftTime];
        }
        return json_encode($rt);
    }

    public function actionGetForgetCode(){
        if (!isset($_POST['phone'])) {
            $rt = ['c'=>-1,'msg'=>'手机号码不能为空'];
            return json_encode($rt);
        }
        $user = User::findByUsername($_POST['phone']);
        if (!is_object($user)){
            $rt = ['c'=>-3,'msg'=>'改手机号码尚未注册'];
            return json_encode($rt);
        }
        $cache = Yii::$app->cache;
        if (!$cache->exists('forgetCode_'.$_POST['phone']))
        {
            $code = UtilHelper::getSendCode();
            $cache->set('forgetCode_'.$_POST['phone'], $code, 60);
            $cache->set('forgetCodeTime_'.$_POST['phone'], time(), 60);
            $rt = ['c'=>0,'msg'=>'验证码已经发送到您的手机上了：'.$code];
            /*$result=smsSendHelper::smsSender($code, $_POST['phone']);
            if($result['result']==0){
                $cache->set('registerCode_'.$_POST['phone'], $code, 600);
                $cache->set('registerCodeTime_'.$_POST['phone'], time(), 60);
                $rt = ['c'=>0,'msg'=>'验证码已经发送到您的手机上了'];
            }else{
                $rt = ['c'=>0,'msg'=>'验证码发送失败'];
            }*/
        }
        else
        {
            $code = $cache->get('forgetCode_'.$_POST['phone']);
            $leftTime = 60 - (time()-$cache->get('forgetCodeTime_'.$_POST['phone']));
            $rt = ['c'=>-2,'code'=>$code,'leftTime'=>$leftTime];
        }
        return json_encode($rt);
    }

    public function actionCheckVerify(){
        if (!isset($_POST['phone'])){
            $rt = ['c'=>-1,'msg'=>'手机号码不能为空'];
            return json_encode($rt);
        }
        if (!isset($_POST['verifyCode'])){
            $rt = ['c'=>-4,'msg'=>'验证码不能为空'];
            return json_encode($rt);
        }
        $name = 'registerCode_'.$_POST['phone'];
        if (isset($_POST['name'])){
            $name = $_POST['name'].$_POST['phone'];
        }
        $rt = UtilHelper::checkVerify($name,$_POST['verifyCode']);
        return json_encode($rt);
    }

    public function actionRegisterValidate()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new SignupForm();
        $model->load(Yii::$app->request->post());
        return \yii\widgets\ActiveForm::validate($model);
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    Yii::$app->session->setFlash('register_message_info',true);
                    return $this->goHome();
                }
            }
        }
        return $this->goHome();
    }
    public function actionReset()
    {
        //return json_encode($_POST);
        $user = User::findByUsername($_POST['username']);
        $bool = Yii::$app->security->validatePassword($_POST['oldPassword'], $user->password_hash);
        if (!$bool){
            $rt = ['c'=>-1,'msg'=>'旧密码不正确'];
            return json_encode($rt);
        }
        $model = new User();
        $model->username = $_POST['username'];
        $model->password = $_POST['password'];
        $res=$model->resetPassword($_POST['username'], $_POST['password']);
        if($res){
            if (Yii::$app->getUser()->login($res)) {
                $rt = ['c'=>0,'msg'=>'修改成功'];
            }else{
                $rt = ['c'=>-2,'msg'=>'自动登录失败'];
            }
        }else{
            $rt = ['c'=>-3,'msg'=>'密码设置有误'];
        }
        return json_encode($rt);
    }

    public function actionDetail(){
        $user = Yii::$app->user->getIdentity();
        $avatar = UploadedFile::getInstanceByName('avatar');
        $dirName='avatar';
        if (!empty($avatar))
        {
            $file = UtilHelper::upload($avatar, $dirName);
            $user->avatar = $file['src'];
        }
        $month = '1';
        $day = '1';
        if (!empty($_POST['year'])){
            if (!empty($_POST['month'])){
                $month = $_POST['month'];
            }
            if (!empty($_POST['day'])){
                $day = $_POST['day'];
            }
            $user->birthday = $_POST['year'].'-'.$month.'-'.$day;
        }
        $user->nickname = $_POST['User']['nickname'];
        $user->fullname = $_POST['User']['fullname'];
        $user->sex = $_POST['User']['sex'];
        if ($user->save()){
            return $this->goBack();
        }
    }

    public function actionCenter(){
        $this->layout = 'center';
        $user = Yii::$app->user->getIdentity();
        $birthday =  explode('-',$user->birthday);
        return $this->render('center\index',['model'=>$user,'birthday'=>$birthday]);
    }
    public function actionInfo(){
        $this->layout = false;
        $user = Yii::$app->user->getIdentity();
        $birthday =  explode('-',$user->birthday);
        return $this->render('center\index',['model'=>$user,'birthday'=>$birthday]);
    }
    public function actionLoginSec(){
        $this->layout = false;
        return $this->render('center\login');
    }
    public function actionAddress(){
        $this->layout = false;
        return $this->render('center\address');
    }
    public function actionTrade(){
        $this->layout = false;
        return $this->render('center\trade');
    }
}
