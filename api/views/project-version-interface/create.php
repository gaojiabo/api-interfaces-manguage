<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProjectVersionInterface */

$this->title = '添加项目接口';
$this->params['breadcrumbs'][] = ['label' => '项目接口', 'url' => ['index','page_id'=>$model->page_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-version-interface-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
