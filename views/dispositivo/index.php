<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DispositivoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dispositivos';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

    'idDispositivo',
    'apelidoDispositivo',
    'nivelBattDispositivo',
    'limiteEnergia',

    [
        'class' => 'yii\grid\ActionColumn',
    ],
];
?>

    <div class="clearfix">
        <div class="pull-left">
            <?= Html::a('Cadastrar um dispositivo', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-md-3">
            <?= ExportMenu::widget([
                'columnBatchToggleSettings' => [
                    'options' => [
                        'class'=> 'checkbox-primary',
                    ]
                ],
                'noExportColumns' => [
                    ['class' => 'yii\grid\ActionColumn']
                ],
                'filename' => 'Dispositivos',
                'showConfirmAlert' => false,
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns
            ]); ?>
        </div>
    </div>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns
    ]); ?>
