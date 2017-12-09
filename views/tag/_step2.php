<?php 
  use kartik\range\RangeInput;
?>

<?= $form->field($model, 'apelidoTag')->textInput() ?>

<?= $form->field($model, 'limMaxTempoUso')->textInput()->label('Máximo tempo uso (min)') ?>

<?= $form->field($model, 'qtdeUsoDia')->widget(RangeInput::classname(), [
    'options' => ['placeholder' => 'Quantidade de uso - 0 -> 5', 'value' => 1],
    'html5Options' => ['min'=>0, 'max'=>5, 'step'=>1],
    'addon' => ['append'=>['content'=>'x']]
]); ?>