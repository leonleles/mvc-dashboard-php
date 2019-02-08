<?php

class Controller {

    private $css = array();
    private $js = array();
    private $data = [];

    public function loadView($viewName) {
        extract($this->data);
        require 'views/' . $viewName . '.php';

    }

    public function loadTemplate($viewName, $viewData = array()) {
        require 'views/index.php';
    }

    public function loadViewInTemplate($viewName) {
        extract($this->data);
        require 'views/' . $viewName . '.php';
    }

    public function set($index, $data){
        $this->data[$index] = $data;
    }

    public function setCss($css) {
        $this->css[] = $css;
    }

    public function setJs($js) {
        $this->js[] = $js;
    }
}