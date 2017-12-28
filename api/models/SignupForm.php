<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SignupForm extends Model
{
    public $username;
    public $password;
    public $repeat_password;

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required','message' => '用户名不能为空'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => '用户名已存在'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'required','message' => '重复密码不能为空'],
            ['password', 'string', 'min' => 6],
            ['repeat_password', 'required','message' => '密码不能为空'],
            ['repeat_password', 'string', 'min' => 6],
            ['repeat_password', 'compare', 'compareAttribute'=>'password','message'=>'重复密码和密码不一样'],

        ];
    }
    //注册
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return Yii::$app->user->login($user, true ? 3600*24*30 : 0);
            }
        }
        return false;
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password' => '密码',
            'repeat_password'=>'重复密码'
        ];
    }
}
