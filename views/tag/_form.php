<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Dispositivo;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Tag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idTag')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'apelidoTag')->textInput() ?>

    <?= $form->field($model, 'limMaxTempoUso')->textInput() ?>

    <?= $form->field($model, 'qtdeUsoDia')->textInput() ?>

    <?php 
        $dispositivo = new Dispositivo();
        $data = $dispositivo->administradorDispositivos;
    ?>

    <?= $form->field($model, 'dispositivos')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($data, 'idDispositivo', 'apelidoDispositivo'),
        'options' => ['placeholder' => 'Selecione um dispositivo...'],
        'pluginOptions' => [
            'multiple' => true,
            'width' => '100%'
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
