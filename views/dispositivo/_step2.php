<?php 
  use kartik\range\RangeInput;
?>

<?= $form->field($model, 'apelidoDispositivo')->textInput(['placeholder' => 'Chuveiro da sala']) ?>

<?= $form->field($model, 'limiteEnergia')->widget(RangeInput::classname(), [
    'options' => ['placeholder' => 'Limite de energia - 0 -> 100', 'value' => 50],
    'html5Options' => ['min'=>0, 'max'=>100, 'step'=>5],
    'addon' => ['append'=>['content'=>'%']]
]); ?>