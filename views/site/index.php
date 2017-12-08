<?php

/* @var $this yii\web\View */
use yii\grid\GridView;

$this->title = 'Dashboard';
?>
        <div class="container">
            <?= $this->render('/uso/_dispositivosAdmin', ['model' => $searchModel]); ?>
            <div class="row">
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
                </div><!-- end col -->
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
                            return "<span data-plugin='peity-donut-alt' data-width='50' data-height='50' data-peity='{ 'fill': ['#71b6f9`', '#435966'], 'innerRadius': 18, 'radius': 28 }''>". $data['consumoMedio']. '/' . $consumoTotal ."</span>" . " " . $data['consumoMedio'].'w';
                        }
                    ],
                    'tag.apelidoTag',
                    // 'idDispositivo',
                ],
            ]); ?>
        </div>
        <!-- container -->