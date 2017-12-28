<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26
 * Time: 10:18
 */

namespace api\core;

use app\models\UserProject;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UnauthorizedHttpException;

class ApiController extends Controller
{
    public $loginActions = [];
    public $guestActions = [];
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => $this->guestActions,
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'actions' => $this->loginActions,
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
}