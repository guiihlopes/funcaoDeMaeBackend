<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Dispositivo */

$this->title = 'Cadastrar dispositivo';
$this->params['breadcrumbs'][] = ['label' => 'Dispositivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dispositivo-create">

<h1><?= Html::encode($this->title) ?></h1>

<?php

$form = ActiveForm::begin([
    'id' => 'dispositivo-form',
    'enableAjaxValidation' => true
]);

$default_buttons = [
    'prev' => ['title' => 'Anterior', 'options' => [ 'class' => 'btn btn-primary', 'type' => 'button']],
    'next' => ['title' => 'Próximo', 'options' => [ 'class' => 'btn btn-primary', 'type' => 'button']],
    'save' => ['title' => 'Salvar', 'options' => [ 'class' => 'btn btn-success', 'type' => 'submit']],
    'skip' => ['title' => 'Pular', 'options' => [ 'class' => 'btn btn-primary', 'type' => 'button']],
];
$wizard_config = [
	'id' => 'stepwizard',
	'steps' => [
            1 => [
                'title' => 'Step 1',
                'icon' => 'glyphicon glyphicon glyphicon-plus',
                'skippable' => false,
                'content' => $this->render('_step1', ['model' => $model, 'form' => $form]),
                'buttons' => $default_buttons,
            ],
            2 => [
                'title' => 'Step 2',
                'icon' => 'glyphicon glyphicon-edit',
                'content' => $this->render('_step2', ['model' => $model, 'form' => $form]),
                'skippable' => false,
                'buttons' => $default_buttons,
            ],
        ],
        'complete_content' => $this->render('_finalStep', ['model' => $model, 'form' => $form]),
        'start_step' => 1, // Optional, start with a specific step
    ];
    ?>
    
    <?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>

    <?php ActiveForm::end(); ?>
    
    </div>
    