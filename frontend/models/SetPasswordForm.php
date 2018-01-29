<?php
namespace frontend\models;

use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;

/**
 * Password reset form
 */
class SetPasswordForm extends Model
{
    public $oldPassword;
    public $password;
    public $verifyPassword;

    /**
     * @var \common\models\User
     */
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password','verifyPassword','oldPassword'],'required'],
            ['password', 'string', 'min' => 6],
            ['verifyPassword', 'compare', 'compareAttribute'=>'password', 'message'=>'请再输入确认密码'],
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
}
