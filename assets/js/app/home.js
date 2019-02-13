require([
    'jquery',
    'ajax',

    'chart-area',
    'chart-pie'
], function ($, ajax) {
    'use strict';

    $(document).click(function () {

        var a = new ajax();

        a.set("usuario","teste", {nome: 'leonardo'},function (res) {
            console.log(res);
        });

        a.execute();

    });

});