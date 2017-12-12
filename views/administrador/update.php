<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Administrador */

$this->title = 'Atualizar meu cadastro';
$this->params['breadcrumbs'][] = ['label' => 'Administradors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idAdmin, 'url' => ['view', 'id' => $model->idAdmin]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="administrador-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
