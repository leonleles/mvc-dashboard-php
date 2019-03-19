<?php

class ServicoController extends Controller{

    const VIEW = "servico";

    public function _construct() {

          $this->setCss('assets/css/bootstrap_4.css');
//        $this->setJs('assets/js/clienteedit.js');

        //Nome da view
        $this->loadTemplate(self::VIEW);
    }
}