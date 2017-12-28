<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProjectPage */

$this->title = '添加项目页面';
$this->params['breadcrumbs'][] = ['label' => '项目页面', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-page-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
