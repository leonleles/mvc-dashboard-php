<?php

class Ajax {

    public function setData ($dados) {
        return json_encode($dados);
    }

    public function getAction(){
        if(isset($_POST['acao']) && $_POST['acao'] != null){
            return $_POST['acao'];
        }elseif (isset($_GET['acao']) && $_GET['acao'] != null){
            return $_GET['acao'];
        }else{
            return "<b>Ação não encontrada.</b>";
        }
    }

    public function getData(){
        if(isset($_POST['dados']) && $_POST['dados'] != null){
            return $_POST['dados'];
        }elseif (isset($_GET['dados']) && $_GET['dados'] != null){
            return $_GET['dados'];
        }else{
            return "<b>Dados não encontrado.</b>";
        }
    }
}