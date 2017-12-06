<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Administrador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="administrador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'senha')->textInput() ?>

    <?= $form->field($model, 'nome')->textInput() ?>

    <?= $form->field($model, 'cpf')->textInput() ?>

    <?= $form->field($model, 'dtNasc')->textInput() ?>

    <?= $form->field($model, 'cep')->textInput() ?>

    <?= $form->field($model, 'logradouro')->textInput() ?>

    <?= $form->field($model, 'numero')->textInput() ?>

    <?= $form->field($model, 'complemento')->textInput() ?>

    <?= $form->field($model, 'bairro')->textInput() ?>

    <?= $form->field($model, 'cidade')->textInput() ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'telefone')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
