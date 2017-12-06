<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Uso */

$this->title = 'Update Uso: ' . $model->idUso;
$this->params['breadcrumbs'][] = ['label' => 'Usos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idUso, 'url' => ['view', 'id' => $model->idUso]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="uso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
