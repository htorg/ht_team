<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\base\Object;
use common\models\SignupForm;
use common\models\User;

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
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'signup', 'flush-cache'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','reset'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
        //return $this->redirect(array('/user-list/index'));
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
    	$this->layout='login';
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
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionSignup()
    {
            $this->layout='login';
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
    public function actionReset()
    {
        $model = User::findOne(\Yii::$app->user->id);

        if (Yii::$app->request->isPost) {
            $rt = [];
            $user = new User();
            $res = $user->resetPassword($model->username, $_POST['password']);
            if ($res) {
                $rt = ['c' => 0, 'msg' => '修改成功'];
            } else {
                $rt = ['c' => -1, 'msg' => '密码设置有误'];
            }
            return json_encode($rt);
        }
        return $this->render('reset', [
            'model' => $model,
        ]);
    }
}
