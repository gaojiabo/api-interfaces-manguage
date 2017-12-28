<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectPage */

$this->title = '修改项目页: ' . $model->page_id;
$this->params['breadcrumbs'][] = ['label' => '项目页面列表', 'url' => ['index','version_id'=>$model->version_id]];
$this->params['breadcrumbs'][] = ['label' => $model->page_id, 'url' => ['view', 'id' => $model->page_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="project-page-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
