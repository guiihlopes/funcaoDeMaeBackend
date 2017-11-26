<?php

namespace app\controllers;

use Yii;
use yii\web\ServerErrorHttpException;
use yii\rest\ActiveController;
use app\models\LoginForm;
use \Firebase\JWT\JWT;

class SiteController extends ActiveController
{
    public $modelClass = 'app\models\LoginForm';
    

    public function actionError(){
        $response = Yii::$app->getResponse();
        $response->setStatusCode(404);
    }
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');

        if ($model->login()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(200);

            $key = "secretT@23!34%55";
            $token = array(
                "user_id" => Yii::$app->user->identity->id,
            );
            $jwt = JWT::encode($token, $key);
            return ['token' => $jwt];
        } else {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(404);
        }
    }
}
