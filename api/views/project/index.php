<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '项目列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">
    <p>
        <?= Html::a('创建项目', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'project_id',
            'project_name',
            'create_at',
            [
               'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {gl}',
                'buttons' => [
                        'view' => function($url,$model){
                            return Html::a('查看项目',['project-version/index','project_id'=>$model->project_id]);
                        },
                        'update' => function($url,$model){
                            return Html::a('修改',$url);
                        },
                        'gl' => function($url,$model){
                            return $model->create_user_id == Yii::$app->user->id ? Html::a('成员管理',['gl','project_id'=>$model->project_id]) : '';
                        }

                ],
            ],
        ],
    ]); ?>
</div>
