<?php

class ajaxExemploController extends Ajax {

    public function _construct () {

        switch ($this->getAction()) {
            case 'teste':
                echo $this->setData($this->getData());
                break;
        }

    }
}