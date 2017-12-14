/**
Template Name: Adminto Dashboard
Author: CoderThemes
Email: coderthemes@gmail.com
File: Chartjs
*/


!function ($) {
    "use strict";

    var ChartJs = function () { };

    ChartJs.prototype.respChart = function (selector, type, data, options) {
        //default config
        Chart.defaults.global.defaultFontColor = "rgba(255,255,255,0.5)";
        // get selector by context
        var ctx = selector.get(0).getContext("2d");
        // pointing parent container to make chart js inherit its width
        var container = $(selector).parent();

        // enable resizing matter
        $(window).resize(generateChart);

        // this function produce the responsive Chart JS
        function generateChart() {
            // make chart width fit with its container
            var ww = selector.attr('width', $(container).width());
            switch (type) {
                case 'Line':
                    new Chart(ctx, { type: 'line', data: data, options: options });
                    break;
                case 'Doughnut':
                    new Chart(ctx, { type: 'doughnut', data: data, options: options });
                    break;
                case 'Pie':
                    new Chart(ctx, { type: 'pie', data: data, options: options });
                    break;
                case 'Bar':
                    new Chart(ctx, { type: 'bar', data: data, options: options });
                    break;
                case 'Radar':
                    new Chart(ctx, { type: 'radar', data: data, options: options });
                    break;
                case 'PolarArea':
                    new Chart(ctx, { data: data, type: 'polarArea', options: options });
                    break;
            }
            // Initiate new chart or Redraw

        };
        // run function - render chart at first load
        generateChart();
    },
        //init
        ChartJs.prototype.init = function () {
            //barchart
            var canvas = $("#bar");
            if (canvas[0]) {
                var data = canvas.data('graph');
                var max;
                var min;
                var datasets = Object.keys(data).map(key => {
                    const obj = data[key];
                    let maxTag = obj.data.find(consumo => Math.max(consumo));
                    let minTag = obj.data.find(consumo => Math.min(consumo));
                    if (max === undefined) {
                        max = maxTag;
                    }
                    if (min === undefined) {
                        min = minTag;
                    }
                    if (max < maxTag) {
                        max = maxTag;
                    }
                    if (minTag < min) {
                        min = minTag;
                    }
                    return {
                        label: key,
                        backgroundColor: obj.color,
                        borderColor: "#188ae2",
                        borderWidth: 1,
                        hoverBackgroundColor: obj.color,
                        hoverBorderColor: "#188ae2",
                        data: obj.data
                    }
                });
                var barChart = {
                    labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                    datasets: datasets
                };
                var barOpts = {
                    scales: {
                        yAxes: [{
                            gridLines: {
                                color: "rgba(255,255,255,0.05)"
                            },
                            ticks: {
                                max: max,
                                min: max === min ? 0 : min,
                                stepSize: (max / min) == 1 ? max : min / max
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                color: "rgba(255,255,255,0.05)"
                            }
                        }]
                    }
                };

                this.respChart($("#bar"), 'Bar', barChart, barOpts);
            }
        },
        $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

}(window.jQuery),

    //initializing
    function ($) {
        "use strict";
        $.ChartJs.init()
    }(window.jQuery);
