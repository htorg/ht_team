<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $password;
    public $nickname;
    public $verifyPassword;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required','message' => '手机号码不能为空'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '手机号码已存在'],
            [['username'],'match','pattern'=>'/^1[0-9]{10}$/','message'=>'手机格式不正确!'],
            ['password', 'required','message' => '密码不能为空'],
            ['password', 'string', 'min' => 6,'message' => '密码不能少于6位'],
            ['verifyPassword', 'compare', 'compareAttribute'=>'password', 'message'=>'两次密码不一致'],
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateAccessToken();
        $user->nickname = $this->nickname;

        return $user->save() ? $user : null;
    }
}
