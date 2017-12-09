<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use app\models\Uso;
use app\models\Dispositivo;
use app\models\UsoSearch;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    

    public function actionError()
    {
        $this->layout = 'guestLayout';
        if (!Yii::$app->user->isGuest) {
            $this->layout = 'main';
        }
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }

        $dispositivo = new Dispositivo();
        $dispositivoIds = ArrayHelper::getColumn($dispositivo->administradorDispositivos, 'idDispositivo');
        $searchModel = new UsoSearch(['idDispositivo' => $dispositivoIds]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $models = $dataProvider->getModels();
        $naoTemResultados = !count($models);
        $consumoMaximo = $naoTemResultados ? 0 : $dataProvider->query->max('consumoMedio');
        $consumoTotal = $naoTemResultados ? 0 : $dataProvider->query->sum('consumoMedio');
        $consumoTotalMedio = $naoTemResultados ? 0 : $consumoTotal/count($models);
        $tempoUsoMaximo = $naoTemResultados ? 0 : $dataProvider->query->max('tempoUso');
        $tempoUsoTotalMedio = $naoTemResultados ? 0 : $dataProvider->query->sum('tempoUso')/count($models);
        $modelsByTag = ArrayHelper::map($models, 'idUso', function($data) {
            return [
                'consumoMedio' => $data['consumoMedio'],
                'tempoUso' => $data['tempoUso'],
            ];
        }, 'tag.apelidoTag');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelsByTagName' => $modelsByTag,
            'consumoMaximo' => $consumoMaximo,
            'consumoTotal' => $consumoTotal,
            'consumoTotalMedio' => $consumoTotalMedio,
            'tempoUsoMaximo' => $tempoUsoMaximo,
            'tempoUsoTotalMedio' => $tempoUsoTotalMedio,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'guestLayout';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
