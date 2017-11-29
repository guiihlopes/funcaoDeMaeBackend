<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dispositivo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dispositivo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idDispositivo')->textInput() ?>

    <?= $form->field($model, 'apelidoDispositivo')->textInput() ?>

    <?= $form->field($model, 'nivelBattDispositivo')->textInput() ?>

    <?= $form->field($model, 'limiteEnergia')->textInput() ?>

    <?= $form->field($model, 'idAdm')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
