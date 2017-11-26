<?php

namespace app\controllers;

class DispositivoController extends \yii\rest\ActiveController
{
  public $modelClass = 'app\models\Dispositivo';

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
