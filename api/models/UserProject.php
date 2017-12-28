<?php

namespace app\models;

use app\core\ApiActiveRecord;
use function Sodium\crypto_box_seed_keypair;
use Yii;

/**

 * This is the model class for table "hl_user_project".
 *
 * @property string $user_id
**/
class UserProject extends ApiActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {

        return '{{%user_project}}';

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'project_id'], 'required'],
            [['user_id', 'project_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'project_id' => 'Project ID',
        ];
    }
    /**
     * 根据用户Id获得用户项目列表
     */
    public static function getProjects($user_id)
    {
        return self::find()->where(['user_id'=>$user_id,'role'=>1])->select('project_id')->asArray()->all();
    }
    /**
     * 根据项目id获得user信息
     */
    public function getUsers()
    {
        return self::hasOne(User::className(),['id'=>'user_id'])->select('id,username');
    }

}
