define('ajax', function () {
    return function () {

        this.data = [];

        this.__construct = function () {
        };

        /**
         * Request
         *
         * Executa um request em um ajax.
         *
         * @param controller {string} Ajax controlador que será requisitado de acordo o manifest.
         * @param acao {string} Ação a ser executada na API.
         * @param dados {string} Dados a serem manipulados no controler.
         * @param call {function} Função a ser executada quando receber um retorno da requisição.
         */
        this.set = function (controller, acao, dados, call) {
            this.data.push({
                controller: controller,
                acao: acao,
                dados: dados,
                call: call
            })
        };


        /**
         * Executa as requisições armazenadas
         */
        this.execute = function () {
            if (this.data.length > 0) {
                $.each(this.data, function (i, v) {
                    $.ajax({
                        url: window.url + "ajax/" + v.controller,
                        type: "POST",
                        data: {
                            acao: v.acao,
                            dados: v.dados
                        },
                        dataType: "json",
                        async: false,
                        success: function (res) {
                            if (v.call) {
                                v.call(res);
                            }
                        }
                    });
                });
            } else {
                console.log("Não possui requisições a serem executadas.");
            }
        };

        this.__construct();

    };
});