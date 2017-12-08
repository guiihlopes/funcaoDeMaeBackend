<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Administrador */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="administrador-form">

    <?php $form = ActiveForm::begin([
        'id' => 'create-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "<div class=\"label-register\">{label}</div><div class=\"col-xs-12\">{input}</div>\n{error}",
            'horizontalCssClasses' => [
                'error' => 'error',
            ],
        ],
    ]); ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'senha')->passwordInput() ?>

    <?= $form->field($model, 'nome')->textInput() ?>

    <?= $form->field($model, 'cpf')->textInput()->
    widget(MaskedInput::className(), [
        'mask' => '999.999.999-99'
    ])  ?>

    <?= $form->field($model, 'dtNasc')->textInput()->
    widget(MaskedInput::className(), [
        'clientOptions' => [
            'alias' => 'date',
        ]
    ]) ?>

    <?= $form->field($model, 'cep')->textInput(['placeholder' => $model->getAttributeLabel('cep')])->
    widget(MaskedInput::className(), [
        'mask' => '99999-999',
    ]) ?>

    <?= $form->field($model, 'logradouro')->textInput() ?>

    <?= $form->field($model, 'numero')->textInput() ?>

    <?= $form->field($model, 'complemento')->textInput() ?>

    <?= $form->field($model, 'bairro')->textInput() ?>

    <?= $form->field($model, 'cidade')->textInput() ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'telefone')->textInput()->
    widget(MaskedInput::className(), [
        'mask' => '9999-9999{1,2}'
    ]) ?>

    <div class="form-group text-center m-t-40">
        <div class="col-xs-12">
            <?= Html::submitButton($model->isNewRecord ? 'Cadastrar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-custom btn-bordred btn-block waves-effect waves-light' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
