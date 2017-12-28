<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectVersion */

$this->title = '修改项目版本: ' . $model->version_id;
$this->params['breadcrumbs'][] = ['label' => '项目版本', 'url' => ['index','project_id'=>$model->project_id]];
$this->params['breadcrumbs'][] = ['label' => $model->version_id, 'url' => ['view', 'id' => $model->version_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="project-version-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
