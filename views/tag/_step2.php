<?php 
  use kartik\range\RangeInput;
  use kartik\select2\Select2;
  use app\models\Dispositivo;
  use yii\helpers\ArrayHelper;
?>

<?= $form->field($model, 'apelidoTag')->textInput() ?>

<?= $form->field($model, 'limMaxTempoUso')->textInput()->label('Máximo tempo uso (min)') ?>

<?= $form->field($model, 'qtdeUsoDia')->widget(RangeInput::classname(), [
    'options' => ['placeholder' => 'Quantidade de uso - 0 -> 5', 'value' => 1],
    'html5Options' => ['min'=>0, 'max'=>5, 'step'=>1],
    'addon' => ['append'=>['content'=>'x']]
]); ?>

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