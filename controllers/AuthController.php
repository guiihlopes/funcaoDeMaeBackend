<?php

namespace app\controllers;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;

class AuthController extends \yii\rest\ActiveController
{
  public function init()
  {
      parent::init();
      \Yii::$app->user->enableSession = false;
  }

  public function behaviors()
  {
      $behaviors = parent::behaviors();
      $behaviors['authenticator'] = [
          'class' => CompositeAuth::className(),
          'authMethods' => [
              HttpBasicAuth::className(),
              HttpBearerAuth::className(),
          ],
      ];
      return $behaviors;
  }
}
