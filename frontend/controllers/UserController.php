<?php
namespace frontend\controllers;

use common\helpers\UtilHelper;
use frontend\components\Controller;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use yii\data\Pagination;
use yii\helpers\VarDumper;
use Codeception\Module;

class UserController extends Controller
{
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

    public function actionGetCmscode(){
        if (!isset($_POST['phone'])) {
            $rt['e'] = 1001;
            $rt['m'] = "缺少必要参数";
            return $rt;
        }
        $cache = Yii::$app->cache;
        if (!$cache->exists('registerCode_'.$_POST['phone']))
        {
            $code = UtilHelper::getSendCode();
            $cache->set('registerCode_'.$_POST['phone'], $code, 600);
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
            $rt = ['c'=>-1,'code'=>$code,'leftTime'=>$leftTime];
        }
        return $rt;
    }

    public function actionCenter(){

        return $this->render('center');
    }

}
