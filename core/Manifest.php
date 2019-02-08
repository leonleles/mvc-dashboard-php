<?php

class Manifest {

    public $arquivo = [];
    public $modulo;
    public $class;

    public function __construct ($array) {
        //Captura o arquivo de manifest
        $this->arquivo = json_decode(file_get_contents('manifest.json'), true);
        //Seta os valores
        $this->modulo = $array['module'];
        $this->class = $array['class'];
    }

    /**
     * Check
     *
     * Verifica se o modulo existe no manifest e retorna true
     *
     * @return bool
     */
    public function check () {
        foreach ($this->arquivo[$this->modulo] as $i => $v) {
            if ($i == $this->class) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get
     *
     * Retorna o caminho do manifest para renderizar a view
     * @return bool|string
     */
    public function getRout () {
        foreach ($this->arquivo[$this->modulo] as $i => $v) {
            if ($i == $this->class) {
                return $v;
            }
        }
        return "";
    }

    /**
     * GetClass
     * @return bool|string
     */
    public function getClass () {
        foreach ($this->arquivo[$this->modulo] as $i => $v) {
            if ($i == $this->class) {
                    return explode("/", $v)[1];
            }
        }
        return "";
    }

}