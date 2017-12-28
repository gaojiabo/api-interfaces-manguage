<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '项目页面列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-page-index">

    <p>
        <?= Html::a('创建页面', ['create','version_id'=>$version_id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'sort',
            'page_name',
            'page_desc',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' =>'{view} {update}',
                'buttons' => [
                    'view' => function($url,$model){
                        return Html::a('查看',['project-version-interface/index','page_id'=>$model->page_id]);
                    },
                    'update' => function($url,$model){
                        return Html::a('修改',$url);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
