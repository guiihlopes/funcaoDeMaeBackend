<?php

namespace app\controllers;

use Yii;
use yii\web\ServerErrorHttpException;
use yii\rest\ActiveController;
use app\models\LoginForm;

class SiteController extends ActiveController
{
    public $modelClass = 'app\models\LoginForm';
    
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
        } else {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(404);
        }
    }
}
