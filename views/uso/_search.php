<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idUso') ?>

    <?= $form->field($model, 'tempoUso') ?>

    <?= $form->field($model, 'dtUso') ?>

    <?= $form->field($model, 'consumoMedio') ?>

    <?= $form->field($model, 'idTag') ?>

    <?php // echo $form->field($model, 'idDispositivo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
