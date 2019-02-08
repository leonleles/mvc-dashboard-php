require(['jquery', 'ajax'], function ($, ajax) {
    'use strict';

    var a = new ajax();

    a.set("ajax","teste", {nome: 'leonardo'},function (res) {
        console.log(res);
    });

    a.execute();

});