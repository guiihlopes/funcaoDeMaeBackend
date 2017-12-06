<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Uso */

$this->title = 'Create Uso';
$this->params['breadcrumbs'][] = ['label' => 'Usos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
