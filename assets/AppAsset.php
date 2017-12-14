<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "css/core.css",
        "css/components.css",
        "css/icons.css",
        "css/pages.css",
        "css/menu.css",
        "css/responsive.css",
    ];
    public $js = [
        'js/modernizr.min.js',
        "js/detect.js",
        "js/fastclick.js",
        "js/jquery.slimscroll.js",
        "js/jquery.blockUI.js",
        "js/waves.js",
        "js/wow.min.js",
        "js/jquery.nicescroll.js",
        "js/jquery.scrollTo.min.js",
        "js/jquery.knob.js",
        "js/jquery.peity.min.js",
        "js/morris.min.js",
        "js/raphael-min.js",
        "js/chart.js/chart.min.js",
        "js/jquery.chartjs.init.js",
        "js/jquery.dashboard.js",
        "js/jquery.core.js",
        "js/jquery.app.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
