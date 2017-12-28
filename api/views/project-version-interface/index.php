<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '项目接口列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-version-interface-index">
    <p>
        <?= Html::a('创建接口', ['create','page_id'=>$page_id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'interface_name',
            'interface_url:url',
            'interface_desc',
            // 'create_user_id',
            // 'create_user_name',
            // 'method',
            // 'param:ntext',
            // 'result:ntext',
            // 'status',
            // 'create_at',
            // 'update_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' =>[
                    'update' => function($url,$model){
                        return Html::a('修改',$url);
                    }
                ],
            ],
        ],
    ]); ?>
</div>
