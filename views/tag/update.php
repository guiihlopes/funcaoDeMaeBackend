<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tag */

$this->title = 'Atualizar tag';
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTag, 'url' => ['view', 'id' => $model->idTag]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tag-update">

    <h1 class="font-25">Tag: <?= $model->apelidoTag ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
