<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dispositivo */

$this->title = 'Update Dispositivo: ' . $model->idDispositivo;
$this->params['breadcrumbs'][] = ['label' => 'Dispositivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idDispositivo, 'url' => ['view', 'id' => $model->idDispositivo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dispositivo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
