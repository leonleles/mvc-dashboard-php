window.name = "NG_DEFER_BOOTSTRAP!";

//Monta a url
var url_atual = window.location.href.split("/");
window.url = "http://" + url_atual[2] + '/' + url_atual[3] + "/";

require.config({
    baseUrl: window.url + "assets/js/",
    paths: {
        'jquery': 'libs/jquery/jquery',
        'bundle': 'libs/bootstrap/bootstrap.bundle',
        'jquery-easing': 'libs/jquery-easing/jquery.easing',
        'chart': 'libs/chart/Chart',
        'chart-area': 'libs/chart/chart-area',
        'chart-pie': 'libs/chart/chart-pie',
        'teste': 'componentes/teste',
        'ajax': 'componentes/Ajax'
    },
    shim: {
        'jquery-easing': {
            deps: 'jquery'
        },
        'chart-area': {
            deps: ['chart']
        },
        'chart-pie': {
            deps: ['chart']
        }
    }

});