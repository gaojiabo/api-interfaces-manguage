<?php

namespace api\controllers;

use api\core\ApiController;
use app\models\User;
use app\models\UserProject;
use common\libs\ToolsClass;
use Yii;
use app\models\Project;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends ApiController
{

    public function init(){
        $this->loginActions = ['index','update','create','gl','add-member','delete-member'];
        return parent::init();
    }

    public function actionIndex()
    {
        $usr_id = Yii::$app->user->id;
        $project_ids = UserProject::getProjects($usr_id);
        if(!empty($project_ids)){
            $pids = ArrayHelper::getColumn($project_ids,'project_id');
        }else{
            $pids = [];
        }
        $dataProvider = new ActiveDataProvider([
            'query' => Project::find()->where(['in','project_id',$pids])->select('project_id,project_name,create_at,create_user_id'),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 成员管理
     */
    public function actionGl($project_id)
    {
        $projectModel = $this->findModel($project_id);
        $projectModel->verifyMemberManage();
        $query = UserProject::find()->where(['project_id'=>$project_id])->select('user_id,username,role')->joinWith('users');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '20']);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();
        //获取所有用户
        $authes = User::find()->asArray()->select('id,username')->all();
        $authes = array_column($authes,'username','id');
        return $this->render('gl',[
            'model' => $model,
            'pages' => $pages,
            'authes' => json_encode($authes),
            'project_id' => $project_id,
        ]);
    }

    /**
     * @param $user_id
     * @return 0/1
     * 从项目中删除成员
     */
    public function actionDeleteMember(){
        $user_id = Yii::$app->request->post('user_id');
        if(!$user_id){
            return false;
        }
        $res = UserProject::findOne(['user_id'=>$user_id])->delete();
        if($res){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $id
     * @return static
     * 向项目中添加成员
     */
    public function actionAddMember(){
        $mem = Yii::$app->request->post('mem');
        $project_id = (int)Yii::$app->request->post('project_id');
        $role = (int)Yii::$app->request->post('role');
        if(!empty($mem) && !empty($project_id)){
            $mrr = explode(':',$mem);
            $user_id = intval(trim($mrr[0],'"'));
            if($user_id){
                $UserProjectObj = new UserProject();
                //若已存在不能重复添加
                if(UserProject::find()->where(['user_id'=>$user_id,'project_id'=>$project_id])->count()){
                    return 1;
                }
                //用户不存在不能添加
                if(!User::findOne($user_id)){
                    return 3;
                }
                $UserProjectObj->user_id = $user_id;
                $UserProjectObj->project_id = $project_id;
                $UserProjectObj->role = $role;
                $res = $UserProjectObj->save();
                if($res){
                    return 2;
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }

    }
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            $model->verifyProjectPermission();
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
