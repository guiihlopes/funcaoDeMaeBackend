<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Uso */

$this->title = $model->idUso;
$this->params['breadcrumbs'][] = ['label' => 'Usos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uso-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idUso], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idUso], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idUso',
            'tempoUso',
            'dtUso',
            'consumoMedio',
            'idTag',
            'idDispositivo',
        ],
    ]) ?>

</div>
