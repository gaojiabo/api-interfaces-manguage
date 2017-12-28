<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectVersionInterface */

$this->title = '修改项目接口: ' . $model->interface_id;
$this->params['breadcrumbs'][] = ['label' => '项目接口列表', 'url' => ['index','page_id'=>$model->page_id]];
$this->params['breadcrumbs'][] = ['label' => $model->interface_id, 'url' => ['view', 'id' => $model->interface_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="project-version-interface-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
