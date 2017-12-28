<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectVersionInterface */

$this->title = $model->interface_id;
$this->params['breadcrumbs'][] = ['label' => '项目接口详情', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-version-interface-view">
    <p>
        <?= Html::a('修改', ['update', 'id' => $model->interface_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'interface_id',
            'page_id',
            'interface_name',
            'interface_url:url',
            'interface_desc',
            'create_user_id',
            'create_user_name',
            'method',
            'param:ntext',
            'result:ntext',
            'status',
            'create_at',
            'update_at',
        ],
    ]) ?>

</div>
