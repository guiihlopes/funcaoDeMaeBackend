<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-center">
    <a href="<?= Url::toRoute('/') ?>" class="logo"><span>Função de <span>mãe</span></span><i class="zmdi zmdi-layers"></i></a>
    <h5 class="text-muted m-t-0 font-600">Controle seu gasto de energia</h5>
</div>
<div class="m-t-40 card-box">
    <div class="text-center">
        <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "<div class=\"col-xs-12\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Email']) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Senha']) ?>

        <div class="form-group text-center m-t-30">
            <div class="col-xs-12">
                <?= Html::submitButton('Log In', ['class' => 'btn btn-custom btn-bordred btn-block waves-effect waves-light', 'name' => 'login-button']) ?>
            </div>
        </div>

        <div class="form-group m-t-30 m-b-0">
            <div class="col-sm-12">
                <a href="page-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
<!-- end card-box-->

<div class="row">
    <div class="col-sm-12 text-center">
        <p class="text-muted">Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>
    </div>
</div>