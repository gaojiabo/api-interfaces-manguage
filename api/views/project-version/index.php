<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '项目管理';
$this->params['breadcrumbs'][] = ['label' => '项目列表', 'url' => ['/project']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("
    $('#select_version').change(function(){
        window.location.href = '".\yii\helpers\Url::to(['index','project_id'=>$project_id])."&version_id='+$(this).val();
    });
");
?>
<div class="project-version-index">
    <p>
    </p>
    <table class="table table-striped table-bordered detail-view">
        <tr>
            <td class="interface_td">版本列表(<?= Html::a('创建新版本', ['create','project_id'=>$project_id]) ?>):</td>
            <td><?= Html::dropDownList('version',$versionView['version_id'],\yii\helpers\ArrayHelper::map($versionList,'version_id','version'),['id'=>'select_version'])?></td>
        </tr>
    </table>
    <table class="table table-striped table-bordered detail-view">
        <tr>
            <td class="interface_td">版本名称</td>
            <td><?=$versionView['version']?>(<?=Html::a('修改',['update','project_id'=>$project_id,'version_id'=>$versionView['version_id']])?>)</td>
        </tr>
        <tr>
            <td class="interface_td">创建时间</td>
            <td><?=$versionView['create_at']?></td>
        </tr>
        <tr>
            <td class="interface_td">版本描述</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">
                <?=$versionView['version_desc']?>
            </td>
        </tr>
    </table>
    <p>
        <?= Html::a('创建新页面', ['/project-page/create','project_id'=>$project_id,'version_id'=>$versionView['version_id']], ['class' => 'btn btn-success']) ?>
    </p>
    <?foreach($pageList as $page):?>
        <table class="table table-striped table-bordered detail-view">
            <tr>
                <td class="child_title" style="width: 90%"><?=$page['page_name']?>(<?=Html::a('添加新接口',['/project-version-interface/create','project_id'=>$project_id,'version_id'=>$versionView['version_id'],'page_id'=>$page['page_id']],['class'=>'create_interface'])?>)</td>
                <td class="child_title"><?=Html::a('修改页面',['/project-page/update','page_id'=>$page['page_id']],['class'=>'create_interface'])?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table-striped table-bordered detail-view interface-list">
                        <tr>
                            <?foreach($page['interface'] as $k=>$interface):?>
                                <td><?=$interface['status'] == 1 ? Html::a($interface['interface_name'],['/project-version-interface/update','version_id'=>$versionView['version_id'],'interface_id'=>$interface['interface_id']]) : Html::a($interface['interface_name'],['/project-version-interface/update','version_id'=>$versionView['version_id'],'interface_id'=>$interface['interface_id']],['class'=>'interface-close'])?></td>
                                <?$k++;
                                if($k % 6 == 0){
                                    echo '</tr><tr>';
                                }
                            endforeach?>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    <?endforeach?>
</div>
