<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Minhas Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-index">

    <p>
        <?= Html::a('Cadastrar tags', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'idTag',
            'apelidoTag',
            [
                'attribute' => 'limMaxTempoUso',
                'value' => function ($data){
                    return number_format($data['limMaxTempoUso']/60, 0) . ' min';
                }
            ],
            'qtdeUsoDia',
            [
                'label' => 'Dispositivos habilitados',
                'value' => function ($data){
                    $tagDispositivos = $data->tagDispositivos;
                    $habilitados = [];
                    foreach($tagDispositivos as $key => $value){
                        array_push($habilitados, $value->dispositivo->apelidoDispositivo);
                    }
                    return implode($habilitados, ', ');
                }
            ],
            // 'idAdmin',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
