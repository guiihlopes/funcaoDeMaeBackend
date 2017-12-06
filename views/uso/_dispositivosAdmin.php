<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Dispositivo;

/* @var $this yii\web\View */
/* @var $model app\models\UsoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idDispositivo')->dropDownList(ArrayHelper::map(Dispositivo::find()->where(['idAdmin' => Yii::$app->user->identity->idAdmin])->all(), 'idDispositivo', 'apelidoDispositivo'))->label('Serial do dispositivo') ?>

    <div class="form-group">
        <?= Html::submitButton('Ver relatório', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
