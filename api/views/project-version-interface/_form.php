<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectVersionInterface */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-version-interface-form">

    <?php $form = ActiveForm::begin(

    ); ?>

    <?= $form->field($model, 'interface_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interface_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interface_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'method')->dropDownList(['GET'=>'GET','POST'=>'POST','PUT'=>'PUT','DELETE'=>'DELETE','OPTIONS'=>'OPTIONS']) ?>
    <div class="row">
        <div class="col-xs-6">
            <?= $form->field($model, 'param')->textarea(['rows' => 6,'placeholder'=>'格式：“字段,类型,说明,默认值”，然后回车写下一个参数']) ?>
        </div>
        <div class="col-xs-6 params_alter">
            <font color="red">参数格式说明</font>:字段名称,字段类型,字段描述,[默认值]<br>
            <font color="red">例</font>:member_id,int,用户ID,1<br>
            多个参数时,每个参数信息占一行
        </div>
        <div style="clear: both"></div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <?= $form->field($model, 'result')->textarea(['rows' => 6,'placeholder'=>'格式：“字段,类型,说明”，然后回车写下一个返回值']) ?>
        </div>
        <div class="col-xs-6 params_alter">
            <font color="red">返回值格式说明</font>:字段名称,字段类型,字段描述<br>
            <font color="red">例</font>:member_id,int,用户ID<br>
            多个返回值时,每个参数信息占一行
        </div>
        <div style="clear: both"></div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <?= $form->field($model, 'status')->dropDownList(['1'=>'开启','2'=>'关闭']) ?>
        </div>
    </div>
<br/>
    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
