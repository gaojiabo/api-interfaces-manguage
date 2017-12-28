<?php

/* @var $this yii\web\View */

$this->title = '首页';
$this->registerJs("
    $('.interface_x').on('click', function(){layer.open({type: 2,title:'接口详情', fix:false,shadeClose:true,maxmin:true,area: ['900px', '800px'],skin: 'layui-layer-rim', content: ['". \yii\helpers\Url::to(['interface-view'])."&id='+$(this).attr('id'), 'yes'] });});
")
?>
<div class="site-index">
    <div class="empty_alert">
        <?=$message?>
    </div>
</div>
