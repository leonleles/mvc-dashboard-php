<?php

class notfoundController extends Controller{

    const VIEW = 'notfound';

	public function _construct(){
		$this->loadTemplate(self::VIEW);
	}

}