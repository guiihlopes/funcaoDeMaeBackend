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
    <?php 
        if($consumoTotal){
    ?>
    <div class="col-lg-3 col-md-6">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Maior consumo vs Consumo total</h4>

            <div class="widget-chart-1">
                <div class="widget-chart-box-1">
                    <input data-plugin="knob" data-width="100" data-height="100" data-fgColor="#f05050"
                        data-bgColor="#F9B9B9" value="<?= !$consumoTotal ? 0 : (($consumoMaximo/$consumoTotal) * 100) ?>"
                        data-skin="tron" data-angleOffset="180" data-readOnly=true
                        data-thickness=".15"/>
                </div>
                <div class="widget-detail-1">
                    <h4 class="p-t-10 m-b-0"> <?= $consumoMaximo . ' watts'?> </h4>
                    <p class="text-muted">Maior consumo</p>
                    <h4 class="p-t-10 m-b-0"> <?= $consumoTotal . ' watts'?> </h4>
                    <p class="text-muted">Consumo total</p>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
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
                            'label' => 'Consumo(watts)',
                            'value' => $consumoTotal,
                            'color' => '#' . random_color(),
                        ];
                    }
                ?>
                <div class="widget-chart text-center">
                    <div id="morris-donut-example" style="height: 245px;" data-graph=<?= json_encode($formattedData) ?>></div>
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
            'value' => function ($data) use ($consumoTotal){
                return "<span data-plugin='peity-pie' data-colors='#f9c851,#435966' data-width='30' data-height='30'>".$data['consumoMedio']. '/' . $consumoTotal ."</span>" . " " . $data['consumoMedio'].'w'. "</span>";
            }
        ],
        'tag.apelidoTag',
        // 'idDispositivo',
    ],
]); ?>