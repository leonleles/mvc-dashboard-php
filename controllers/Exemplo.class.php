<?php

class Exemplo extends Controller {

    const VIEW = 'exemplo';

    public function _construct() {

        $this->setCss('assets/css/exemplo.css');
        $this->setJs('assets/js/clienteedit.js');

        //Nome da view
        $this->loadTemplate(self::VIEW);
    }
}