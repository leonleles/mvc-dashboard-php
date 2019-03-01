<?php


class usuario extends Ajax {

    public function teste () {
        $v = new MExemplo();
        return $v->salvar();
    }
}