<?php

namespace api\controllers;

use api\core\ApiController;
use app\models\Project;
use common\libs\ToolsClass;
use Yii;
use app\models\ProjectVersion;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UserProject;
/**
 * ProjectVersionController implements the CRUD actions for ProjectVersion model.
 */
class ProjectVersionController extends ApiController
{

    public function init(){
        $this->loginActions = ['index','update','create'];
        return parent::init();
    }

    public function actionIndex($project_id)
    {
        $version_id = (int)Yii::$app->request->get('version_id');
        $versionModel = new ProjectVersion();
        list($versionList,$versionView,$pageList) = $versionModel->getVersionListData($project_id,$version_id);
        if($versionList){
            return $this->render('index', [
                'project_id'=>$project_id,
                'versionList' => $versionList,
                'versionView'=>$versionView,
                'pageList'=>$pageList
            ]);
        }else{
            return $this->render('/site/empty',['message'=>'该项目还没有添加任何版本!<br>['.Html::a('返回项目列表',['/project']).'|'.Html::a('创建版本',['create','project_id'=>$project_id]).']']);
        }
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate($project_id)
    {
        $model = new ProjectVersion();
        $model->project_id = (int)$project_id;
        $model->verifyProjectPermission();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index','project_id'=>$model->project_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($version_id)
    {
        $model = $this->findModel($version_id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index','project_id'=>$model->project_id,'version_id'=>$model->version_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = ProjectVersion::findOne($id)) !== null) {
            $model->verifyProjectPermission();
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
