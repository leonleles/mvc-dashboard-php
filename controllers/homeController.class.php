<?php

class homeController extends Controller{

    const VIEW = 'home';

	public function _construct(){

        $this->setJs('assets/js/app/home.js');

        $this->set("teste", ["asdasd", "assdasdsad", "dffgfgfdg"]);

		$this->loadTemplate(self::VIEW);
	}

}