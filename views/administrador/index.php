<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdministradorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administradors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrador-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Administrador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idAdmin',
            'email:email',
            'senha',
            'nome',
            'cpf',
            // 'dtNasc',
            // 'cep',
            // 'logradouro',
            // 'numero',
            // 'complemento',
            // 'bairro',
            // 'cidade',
            // 'estado',
            // 'telefone',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
