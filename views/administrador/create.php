<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Administrador */

$this->title = 'Registrar usuário';
$this->params['breadcrumbs'][] = ['label' => 'Administradors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-center">
    <a href="<?= Url::toRoute('/') ?>" class="logo"><span>Função de <span>Mãe</span></span></a>
    <h5 class="text-muted m-t-0 font-600">Controle seu gasto de energia</h5>
</div>
<div class="m-t-40 card-box">
    <div class="text-center">
        <h4 class="text-uppercase font-bold m-b-0"><?= $this->title ?></h4>
    </div>
    <div class="panel-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
    <!-- end card-box -->
    
<div class="row">
    <div class="col-sm-12 text-center">
        <p class="text-muted">Já tem uma conta?<a href="<?= Url::toRoute('site/login') ?>" class="text-primary m-l-5"><b>Entre</b></a></p>
    </div>
</div>