<?php

namespace app\controllers;

use Yii;
use app\models\Tag;
use app\models\TagSearch;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * TagController implements the CRUD actions for Tag model.
 */
class TagController extends Controller
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
     * Lists all Tag models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TagSearch(['idAdmin' => Yii::$app->user->identity->idAdmin]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tag model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tag();
        $model->scenario = 'register';

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $tag = $this->findModel($model->idTag, true);
            $tag->idAdmin = Yii::$app->user->identity->idAdmin;
            $tag->apelidoTag = $model->apelidoTag;
            $tag->limMaxTempoUso = $model->limMaxTempoUso;
            $tag->qtdeUsoDia = $model->qtdeUsoDia;
            $tag->dispositivos = $model->dispositivos;
            if($tag->validate()){
                $tag->save();
                return $this->redirect(['index']);
            }
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $tagDispositivos = $model->getTagDispositivos()->all();
        $dispositivos = \yii\helpers\ArrayHelper::getColumn($tagDispositivos, 'idDispositivo');
        $model->dispositivos = $dispositivos;
        $model->limMaxTempoUso = number_format($model->limMaxTempoUso/60, 0);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $tag = $this->findModel($id);
        $tag->scenario = 'delete';
        $tag->idAdmin = '';
        $tag->dispositivos = null;
        $tag->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Tag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $bypassAdmin = false)
    {
        if (($model = Tag::findOne($id)) !== null && ($bypassAdmin || $model->administrador->idAdmin === Yii::$app->user->identity->idAdmin)) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
