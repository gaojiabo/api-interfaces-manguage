<?php

$this->title = '注册';
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\User;
\api\assets\AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title.'-'.Yii::$app->name)?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<div class="demo form-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-5">
                <?php $form=ActiveForm::begin(['id'=>'da-login-form']);?>
                    <span class="heading">用户注册</span>
                    <div class="form-group">
                        <?= $form->field($model, 'username')?>
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="form-group help">
                        <?= $form->field($model, 'password')->passwordInput()?>
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>
                    <div class="form-group help">
                        <?= $form->field($model, 'repeat_password')->passwordInput()?>
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>
                    <div class="form-group dl">
                        <?= Html::submitButton('提交',['class'=>'btn btn-success'])?>
                    </div>
                <?php ActiveForm::end();?>
            </div>
        </div>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<style type="text/css">
    .heading{
        font-size: large;
        font-weight: 700;
        padding-left: 160px;
    }
    .dl{
        text-align: center;
    }
    #da-login-form{
        padding: 25px;
        border: 1px solid #c0c0c0;
        border-radius: 5px;
    }
    .demo{
        padding-top: 180px;
    }
</style>