<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectVersion */

$this->title = $model->version_id;
$this->params['breadcrumbs'][] = ['label' => '项目版本', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-version-view">
    <p>
        <?= Html::a('修改', ['update', 'id' => $model->version_id], ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::a('Delete', ['delete', 'id' => $model->version_id], [
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
            'version_id',
            'project_id',
            'version',
            'version_desc',
            'create_at',
        ],
    ]) ?>

</div>
