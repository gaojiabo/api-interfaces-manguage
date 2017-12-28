<?php

namespace api\controllers;

use api\core\ApiController;
use Yii;
use app\models\ProjectPage;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectPageController implements the CRUD actions for ProjectPage model.
 */
class ProjectPageController extends ApiController
{
    public function init(){
        $this->loginActions = ['index','update','create'];
        return parent::init();
    }

    public function actionIndex()
    {
        $version_id = Yii::$app->request->get('version_id');
        $dataProvider = new ActiveDataProvider([
            'query' => ProjectPage::find()->andWhere(['version_id'=>$version_id])->orderBy('sort desc,version_id asc'),
        ]);
        return $this->render('index', [
            'version_id'=>$version_id,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate($project_id,$version_id)
    {
        $model = new ProjectPage();
        $model->version_id = (int)$version_id;
        $model->project_id = (int)$project_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/project-version','project_id'=>$model->project_id,'version_id'=>$model->version_id]);
        } else {
            $model->loadDefaultValues();
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($page_id)
    {
        $model = $this->findModel($page_id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/project-version','project_id'=>$model->project_id,'version_id'=>$model->version_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = ProjectPage::findOne($id)) !== null) {
            $model->verifyProjectPermission();
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
