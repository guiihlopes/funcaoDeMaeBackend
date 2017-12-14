<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Minhas Tags';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [
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
];
?>
<div class="tag-index">

    <div class="clearfix">
        <div class="pull-left">
            <?= Html::a('Cadastrar tags', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-md-3">
            <?= ExportMenu::widget([
                'columnBatchToggleSettings' => [
                    'options' => [
                        'class'=> 'checkbox-primary',
                    ]
                ],
                'noExportColumns' => [
                    ['class' => 'yii\grid\ActionColumn']
                ],
                'filename' => 'Tags',
                'showConfirmAlert' => false,
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns
            ]); ?>
        </div>
    </div>
    <hr>
    <?php
        // You can choose to render your own GridView separately
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumns
        ]);
    ?>
</div>
