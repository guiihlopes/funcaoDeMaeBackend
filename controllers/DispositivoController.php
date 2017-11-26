<?php

namespace app\controllers;

use app\models\Dispositivo;
use yii\data\ActiveDataProvider;

class DispositivoController extends AuthController
{
  public $modelClass = 'app\models\Dispositivo';

  public function actions()
  {
      $actions = parent::actions();
  
      // customize the data provider preparation with the "prepareDataProvider()" method
      $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
  
      return $actions;
  }
  public function prepareDataProvider()
  {
    // prepare and return a data provider for the "index" action
    $provider = new ActiveDataProvider([
        'query' => Dispositivo::find()->where(['id_administrador' => \Yii::$app->user->identity->id]),
    ]);
    
    return $provider;
  }

  public function checkAccess($action, $model = null, $params = [])
  {
      // check if the user can access $action and $model
      // throw ForbiddenHttpException if access should be denied
      if ($action === 'view') {
          if ($model->id_administrador !== \Yii::$app->user->id)
              throw new \yii\web\ForbiddenHttpException(sprintf('Pode ver somente dispositivos criados pelo seu usuario', $action));
      }
  }
}
