<?php

namespace app\core;

use app\models\UserProject;
use Yii;
use yii\web\UnauthorizedHttpException;

class ApiActiveRecord extends \yii\db\ActiveRecord
{
    public function verifyProjectPermission(){
        if(isset($this->project_id)){
            if(!UserProject::find()->where(['user_id'=>Yii::$app->user->id,'project_id'=>$this->project_id,'role'=>1])->count()){
                throw new UnauthorizedHttpException();
            }
        }
    }
}
