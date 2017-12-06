<?php

/* @var $this yii\web\View */
use yii\grid\GridView;

$this->title = 'Dashboard';
?>
        <div class="container">
            <?= $this->render('/uso/_dispositivosAdmin', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'idUso',
                    'tempoUso',
                    'dtUso',
                    'consumoMedio',
                    'idTag',
                    // 'idDispositivo',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Statistics</h4>

                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#ffbd4a"
                                    data-bgColor="#FFE6BA" value="80"
                                    data-skin="tron" data-angleOffset="180" data-readOnly=true
                                    data-thickness=".15"/>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0"> 4569 </h2>
                                <p class="text-muted">Revenue today</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- container -->