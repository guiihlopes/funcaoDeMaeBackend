<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Uso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tempoUso')->textInput() ?>

    <?= $form->field($model, 'dtUso')->textInput() ?>

    <?= $form->field($model, 'consumoMedio')->textInput() ?>

    <?= $form->field($model, 'idTag')->textInput() ?>

    <?= $form->field($model, 'idDispositivo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
