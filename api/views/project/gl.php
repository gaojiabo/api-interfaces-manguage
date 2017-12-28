<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use api\assets\AppAsset;
$this->title = '成员管理';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('static/js/jquery-ui.js',['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_END]);
$this->registerCssFile('static/css/jquery-ui.min.css');
$this->registerJs("
        //自动完成 
        var authes = '".$authes."';
        authes = authes.substr(1).substr(0,authes.length-2);
        var availableTags = authes.split(',');     
        $(function() {
            $('#tags').autocomplete({source: availableTags});
        });
        //点击删除
        $('.del').click(function(){  
            __this = $(this);
            //询问框
            layer.confirm('确定要删除该成员吗？', {
              btn: ['确定','取消'] //按钮
            }, function(){                
                var user_id = __this.parents('tr').find('td:first').text();              
                var path = '".Url::to(['delete-member'])."';
                $.ajax({
                    type:'post',
                    data:{user_id:user_id},
                    url:path,
                    success:function (phpdata) {
                        if(phpdata){
                        __this.parents('tr').remove();
                            layer.msg('删除成功');
                        }else{
                            layer.msg('删除失败');
                            return false;
                        }
                    }
                })
            }, function(){
//              layer.msg('也可以这样', {
//                time: 2000, //2s后自动关闭       
//              });
            });
        
      
        })
        //点击添加
        $('#confirm-mem').click(function () {
        var mem = $('#tags').val();
        var role = $('#role').val();
        var project_id = $project_id;        
        if(!mem){
            layer.msg('请搜索并选择您要添加的成员');
            return false;
        }else{
            var addpath = '".Url::to(['add-member'])."';
            $.ajax({
                url:addpath,
                data:{mem:mem,project_id:project_id,role:role},
                type:'post',
                success:function (res) {
                    if(res == 2){                     
                        layer.msg('添加成功');
                        window.location.reload();
                    }else if(res == 1){
                        layer.msg('项目组成员不可重复添加！');
                    }else if(res == 3){
                        layer.msg('您要添加的成员不存在！');
                    }else{
                        layer.msg('添加失败');
                    }
                }
            });
        }
    })
       
");
?>
<style>
    .ui-autocomplete {
        /*max-height: 200px;*/
        /*overflow-y: auto;*/
        /* 防止水平滚动条 */
        /*overflow-x: hidden;*/
    }
    /* IE 6 不支持 max-height
     * 我们使用 height 代替，但是这会强制菜单总是显示为那个高度
     */
    * html .ui-autocomplete {
        height: 200px;
    }
</style>
<div class="project-index" style="margin-bottom: 20px;">
    <div class="input-group" style="width: 515px;">
      <span class="input-group-btn">
        <button class="btn btn-secondary" type="button">添加项目成员</button>
      </span>
        <input type="text" id="tags" data-list="" class="form-control ui-autocomplete-input" style="width: 180px;" autocomplete="off" data-provide="typeahead" data-items="10" placeholder="请输入成员姓名">
        <span class="input-group-btn" style="width: 130px">
            <?= Html::dropDownList('role',1,[1=>'接口开发者',2=>'接口使用者'],['class' => 'form-control','id'=>'role'])?>
        </span>
        <span class="input-group-btn">
        <button class="btn btn-secondary btn-success" id="confirm-mem" type="button">添加该成员</button>
      </span>
    </div>
</div>
<script type="text/javascript">

</script>


<div class="project-index">
    <div class="box-body">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>用户 ID</th>
                <th>用户名</th>
                <th>角色</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <? foreach ($model as $v):?>
                <tr>
                    <td><?=Html::encode($v['user_id'])?></td>
                    <td><?=Html::encode($v['username'])?></td>
                    <td><?= $v['role'] == 1 ? "开发者" : "使用者"?></td>
                    <td><?= Html::a('删除',null,['href'=>'javascript:;','class'=>'del'])?></td>
                </tr>
            <? endforeach;?>
            </tbody>
        </table>
        <? echo LinkPager::widget([
            'pagination' => $pages,
        ]);?>
    </div>
</div>
