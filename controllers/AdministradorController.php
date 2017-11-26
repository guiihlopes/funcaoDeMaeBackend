<?php

namespace app\controllers;

class AdministradorController extends \yii\rest\ActiveController
{
  public $modelClass = 'app\models\Administrador';

  public function actions()
  {
      $actions = parent::actions();
  
      // disable the "delete" and "create" actions
      unset($actions['delete']);
  
      return $actions;
  }
}
