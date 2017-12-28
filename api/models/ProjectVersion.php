<?php

namespace app\models;

use app\core\ApiActiveRecord;
use Yii;

/**
 * This is the model class for table "{{%project_version}}".
 *
 * @property integer $version_id
 * @property integer $project_id
 * @property string $version
 * @property string $version_desc
 * @property string $create_at
 */
class ProjectVersion extends ApiActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%project_version}}';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'version'], 'required'],
            [['project_id'], 'integer'],
            [['create_at'], 'safe'],
            [['version'], 'string', 'max' => 10],
            [['version_desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'version_id' => '版本 ID',
            'project_id' => '项目 ID',
            'version' => '版本名称',
            'version_desc' => '版本描述',
            'create_at' => '生成时间',
        ];
    }
    /**
     * 获取项目信息
     */
    public function getPro(){
        return $this->hasOne(Project::className(),['project_id'=>'project_id']);
    }
    /*
     * 获取版本列表页的数据
     * */
    public function getVersionListData($project_id,$version_id = ''){

        $versionList = self::find()->where(['project_id'=>$project_id])->select('version,version_id')->orderBy('version_id desc')->asArray()->all();
        if(empty($versionList)){
            return [
              [],[],[]
            ];
        }
        $version_id = empty($version_id) ? $versionList[0]['version_id'] : $version_id;
        $versionView = self::find()->where(['version_id'=>$version_id])->asArray()->one();
        $pageList = ProjectPage::find()->where(['version_id'=>$version_id])->select('page_name,page_id')->orderBy('sort desc,page_id asc')->asArray()->all();
        foreach($pageList as $key=>$page){
            $pageList[$key]['interface'] = ProjectVersionInterface::find()->where(['page_id'=>$page['page_id']])->select('interface_name,interface_id,status')->asArray()->all();
        }
        return [$versionList,$versionView,$pageList];
    }
    public static function getProjectId($version_id){
        $projectVersion = ProjectVersion::find()->where(['version_id'=>$version_id])->select('project_id')->asArray()->one();
        return $projectVersion['project_id'];
    }
}
