<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProjectVersion */

$this->title = '创建版本';
$this->params['breadcrumbs'][] = ['label' => '版本列表', 'url' => ['index','project_id'=>$model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-version-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
