
/**
* Theme: Adminto Admin Template
* Author: Coderthemes
* Dashboard
*/

!function ($) {
    "use strict";

    var Dashboard1 = function () {
        this.$realData = []
    };

    //creates Donut chart
    Dashboard1.prototype.createDonutChart = function (element, data, colors) {
        Morris.Donut({
            element: element,
            data: data,
            resize: true, //defaulted to true
            colors: colors,
            backgroundColor: '#2f3e47',
            labelColor: '#fff'
        });
    },


        Dashboard1.prototype.init = function () {

            var $id = 'morris-donut-example';
            var $graphNode = document.querySelector('#' + $id);
            var json = JSON.parse($graphNode.getAttribute('data-graph'));
            var parsedJson = Object.keys(json).map(key => json[key]);
            var colors = parsedJson.map(obj => obj.color);
            var $donutData = parsedJson.map(obj => {
                delete obj.color;
                return obj;
            });
            this.createDonutChart($id, $donutData, colors);
        },
        //init
        $.Dashboard1 = new Dashboard1, $.Dashboard1.Constructor = Dashboard1
}(window.jQuery),

    //initializing 
    function ($) {
        "use strict";
        $.Dashboard1.init();
    }(window.jQuery);