<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Uso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idUso',
            'tempoUso',
            'dtUso',
            'consumoMedio',
            'idTag',
            // 'idDispositivo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
