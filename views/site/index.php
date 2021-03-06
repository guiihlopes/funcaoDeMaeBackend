<?php

/* @var $this yii\web\View */
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;

$this->title = 'Dashboard';

$gridColumns = [
    [
        'attribute' => 'tempoUso',
        'value' => function ($data) {
            return (number_format($data['tempoUso']/60, 0)).' minutos';
        }
    ],
    [
        'attribute' => 'dtUso',
        'value' => function($data){
            $year = substr($data['dtUso'], 0, 4);
            $month = substr($data['dtUso'], 4, 2);
            $day = substr($data['dtUso'], 6, 2);
            $hour = substr($data['dtUso'], 9, 2);
            $min = substr($data['dtUso'], 12, 2);
            $second = substr($data['dtUso'], 15, 2);
            if($second < 10){
                $second = '0' . $second;
            }
            // $dtUso = $year . $month . $day . ' ' . $hour . ':' . $min . ':' . $second;
            $dtUso = $day . '/' . $month . '/' . $year .  ' ' . $hour . ':' . $min . ':' . $second;
            $date = \DateTime::createFromFormat('Ymd G:i:s', $dtUso);
            // var_dump($date->format('d/m/Y G:i:s'));
            // die();
            return $dtUso;
        }
    ],
    [
        'attribute' => 'consumoMedio',
        'format' => 'raw',
        'value' => function ($data){
            
            return $data['consumoMedio'].'w';
        }
    ],
    'tag.apelidoTag',
    // 'idDispositivo',
];

function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}
?>
<?= $this->render('/uso/_dispositivosAdmin', ['model' => $searchModel]); ?>
<div class="row">
    <?php 
        if(count($modelsByTagName)){
    ?>
    <div class="col-lg-6">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Consumo por mês</h4>
            <?php 
                foreach ($modelsByTagName as $key => $value){
                    $consumoPerMonth = [
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                    ];
                    foreach($value as $index => $consumo){
                        if(isset($consumo['consumoMedio']))
                            $consumoPerMonth[$consumo['mesUso'] - 1] += $consumo['consumoMedio'];
                    }
                    $formattedData[$key] = [
                        'label' => utf8_encode('Consumo(watts)'),
                        'data' => $consumoPerMonth,
                        'value' => array_sum($consumoPerMonth),
                        'color' => utf8_encode('#' . random_color()),
                    ];
                }
            ?>
            <canvas id="bar" height="300" data-graph='<?= json_encode($formattedData) ?>'></canvas>
        </div>
    </div><!-- end col-->
    <!-- end col -->
    <div class="col-lg-6">
        <div class="card-box">
            <h4 class="header-title m-t-0">Consumo por tags</h4>
            <div class="widget-chart text-center">
                <div id="morris-donut-example" style="height: 291px;" data-graph='<?= json_encode($formattedData) ?>'></div>
                <ul class="list-inline chart-detail-list m-b-0">
                    <?php 
                        foreach ($formattedData as $key => $value){
                    ?>
                        <li>
                            <h5 style="color: <?= $value['color'] ?>;"><i class="fa fa-circle m-r-5"></i><?= $key ?></h5>
                        </li>
                    <?php 
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div><!-- end col-->
    <?php
        }
    ?>
</div>
<!-- end row -->
<?= ExportMenu::widget([
    'columnBatchToggleSettings' => [
        'options' => [
            'class'=> 'checkbox-primary',
        ]
    ],
    'filename' => 'Uso',
    'showConfirmAlert' => false,
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns
]); ?>
<hr>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
]); ?>