<?php

namespace app\controllers;

use Yii;
use app\models\Dispositivo;
use app\models\DispositivoSearch;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * DispositivoController implements the CRUD actions for Dispositivo model.
 */
class DispositivoController extends Controller
{
    /**
     * @inheritdoc
     */
     public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'create', 'view', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'create', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return (Yii::$app->user->identity !== null);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }   

    /**
     * Lists all Dispositivo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DispositivoSearch(['idAdmin' => Yii::$app->user->identity->idAdmin]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Dispositivo model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Dispositivo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dispositivo();
        $model->scenario = 'register';

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $dispositivo = $this->findModel($model->idDispositivo, true);
            $dispositivo->idAdmin = Yii::$app->user->identity->idAdmin;
            $dispositivo->apelidoDispositivo = $model->apelidoDispositivo;
            $dispositivo->limiteEnergia = $model->limiteEnergia;
            if($dispositivo->validate()){
                $dispositivo->save();
                return $this->redirect(['index']);
            }
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Dispositivo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idDispositivo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Dispositivo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $dispositivo = $this->findModel($id);

        $dispositivo->idAdmin = '';
        $dispositivo->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dispositivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Dispositivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $bypassValidate = false)
    {
        if (($model = Dispositivo::findOne($id)) !== null && ($bypassValidate || $model->administrador->idAdmin === Yii::$app->user->identity->idAdmin)) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
