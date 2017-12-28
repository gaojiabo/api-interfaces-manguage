<?php

namespace app\models;

use app\core\ApiActiveRecord;
use Yii;

/**
 * This is the model class for table "{{%project_page}}".
 *
 * @property integer $page_id
 * @property integer $version_id
 * @property string $page_name
 * @property string $page_desc
 * @property string $username
 * @property integer $sort
 */
class ProjectPage extends ApiActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%project_page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['version_id', 'page_name'], 'required'],
            [['version_id', 'sort','project_id'], 'integer'],
            [['page_name', 'page_desc'], 'string', 'max' => 255],
            //[['username'], 'string', 'max' => 20],
        ];
    }
    public function beforeSave($insert){
        if($insert){
            $this->project_id = ProjectVersion::getProjectId($this->version_id);
        }
        return parent::beforeSave($insert);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => 'Page ID',
            'version_id' => 'Version ID',
            'page_name' => '页面名称',
            'page_desc' => '页面描述',
            'username' => '用户名',
            'sort' => '排序',
        ];
    }
    public static function getProjectId($page_id){
        $pageModel = ProjectPage::find()->where(['page_id'=>$page_id])->select('project_id')->asArray()->one();
        return $pageModel['project_id'];
    }
}
