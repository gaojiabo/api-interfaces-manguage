<?php

namespace api\controllers;

use api\core\ApiController;
use Yii;
use app\models\ProjectVersionInterface;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectVersionInterfaceController implements the CRUD actions for ProjectVersionInterface model.
 */
class ProjectVersionInterfaceController extends ApiController
{
    public function init(){
        $this->loginActions = ['index','update','create'];
        return parent::init();
    }

    public function actionIndex()
    {
        $page_id = Yii::$app->request->get('page_id');
        $dataProvider = new ActiveDataProvider([
            'query' => ProjectVersionInterface::find()->andWhere(['page_id'=>$page_id]),
        ]);
        return $this->render('index', [
            'page_id'=>$page_id,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate($project_id,$version_id,$page_id)
    {
        $model = new ProjectVersionInterface();
        $model->page_id = (int)$page_id;
        $model->project_id = $project_id;
        $model->verifyProjectPermission();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/project-version', 'project_id' => $model->project_id,'version_id'=>$version_id]);
        } else {
            $model->loadDefaultValues();
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($version_id,$interface_id)
    {
        $model = $this->findModel($interface_id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/project-version', 'project_id'=>$model->project_id,'version_id'=>$version_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = ProjectVersionInterface::findOne($id)) !== null) {
            $model->verifyProjectPermission();
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
