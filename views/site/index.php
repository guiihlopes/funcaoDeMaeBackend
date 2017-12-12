<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

$this->title = 'Dashboard';

function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}
?>
<?= $this->render('/uso/_dispositivosAdmin', ['model' => $searchModel]); ?>
<div class="row">
    <!-- end col -->
    <?php 
        if(count($modelsByTagName)){
    ?>
        <div class="col-lg-6">
            <div class="card-box">
                <h4 class="header-title m-t-0">Consumo por tags</h4>
                <?php 
                    $formattedData = [];
                    foreach ($modelsByTagName as $key => $value){
                        $consumoTotal = 0;
                        foreach($value as $index => $consumo){
                            if(isset($consumo['consumoMedio']))   
                                $consumoTotal += $consumo['consumoMedio'];
                        }
                        $formattedData[$key] = [
                            'label' => utf8_encode('Consumo(watts)'),
                            'value' => utf8_encode($consumoTotal),
                            'color' => utf8_encode('#' . random_color()),
                        ];
                    }
                ?>
                <div class="widget-chart text-center">
                    <div id="morris-donut-example" style="height: 245px;" data-graph='<?= json_encode($formattedData) ?>'></div>
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
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'attribute' => 'tempoUso',
            'value' => function ($data) {
                return (number_format($data['tempoUso']/60, 0)).' minutos';
            }
        ],
        'dtUso',
        [
            'attribute' => 'consumoMedio',
            'format' => 'raw',
            'value' => function ($data){
                
                return $data['consumoMedio'].'w';
            }
        ],
        'tag.apelidoTag',
        // 'idDispositivo',
    ],
]); ?>