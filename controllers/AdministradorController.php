<?php

namespace app\controllers;

class AdministradorController extends AuthController
{
  public $modelClass = 'app\models\Administrador';

  public function actions()
  {
      $actions = parent::actions();
  
      // disable the "delete" and "create" actions
      unset($actions['delete'], $actions['index']);
  
      return $actions;
  }
  public function checkAccess($action, $model = null, $params = [])
  {
      // check if the user can access $action and $model
      // throw ForbiddenHttpException if access should be denied
      if ($action === 'view') {
          if ($model->id !== \Yii::$app->user->id)
              throw new \yii\web\ForbiddenHttpException(sprintf('Pode ver somente seu usuario', $action));
      }
  }
}
