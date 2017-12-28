<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectPage */

$this->title = $model->page_id;
$this->params['breadcrumbs'][] = ['label' => '项目页面', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-page-view">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->page_id], ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::a('Delete', ['delete', 'id' => $model->page_id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'page_id',
            'version_id',
            'page_name',
            'page_desc',
            'sort',
        ],
    ]) ?>

</div>
