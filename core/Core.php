<?php

class Core {

    /**
     * Classe de erro.
     */
    const CLASS_ERROR = 'notfoundController';
    /**
     * Método que será verificado nas classes.
     */
    const CURRENT_ACTION = "_construct";
    /**
     * Controlador que será a home do app
     */
    const CLASS_HOME = 'homeController';

    public function run() {
        $module = null;

        $url = '/';
        if (isset($_GET['url'])) {
            $url .= $_GET['url'];
        }

        $url = $this->checkRoutes($url);

        $params = array();

        $currentController = self::CLASS_HOME;
        $file = "controllers/".self::CLASS_HOME;
        $currentAction = self::CURRENT_ACTION;

        if (!empty($url) && $url != '/') {
            $explode = explode("/", $url);

            if (count($explode) == 3 && isset($explode[2]) && strlen($explode[2]) > 0) {
                $url = explode('/', $url);
                array_shift($url);
                $module = $url[0];

                $m = new Manifest(["module" => $url[0], "class" => $url[1]]);

                $currentController = $m->getClass();
                $file = $m->getRout();
                array_shift($url);

                if (isset($url[1]) && !empty($url[1])) {
                    $currentAction = $m->getRout();
                    array_shift($url);
                } else {
                    $currentAction = self::CURRENT_ACTION;
                }

                if ($url > 0) {
                    $params = $url;
                }
            }else {
                if (isset($explode[2]) && $explode[2] != "") {
                    $currentController = self::CLASS_ERROR;
                    $currentAction = self::CURRENT_ACTION;
                }
            }
        }

        if(
            ($module != null && $module == 'ajax') &&
            isset($_POST['action_ajax_post']) &&
            method_exists($currentController, $_POST['action_ajax_post'])
        ){
            $currentAction = $_POST['action_ajax_post'];
            unset($_POST['action_ajax_post']);
            $params = $_POST;
        }

        if (!file_exists($file . '.class.php') || !method_exists($currentController, $currentAction)) {
            $currentController = self::CLASS_ERROR;
            $currentAction = self::CURRENT_ACTION;
        }

        $c = new  $currentController();

        $result = call_user_func_array(array($c, $currentAction), $params);

        if($module == 'ajax'){
            echo json_encode($result);
        }
    }

    public function checkRoutes($url) {
        global $routes;

        foreach ($routes as $pt => $newurl) {

            // Indentifica os argumentos e substitui por regex(expressões regulares)
            $pattern = preg_replace('(\{[a-z0-9]{1,}\})', '([a-z0-9-]{1,})', $pt);

            // Faz o match da url
            if (preg_match('#^(' . $pattern . ')*$#i', $url, $matches) === 1) {
                array_shift($matches);
                array_shift($matches);

                // Pega todos os argumentos para associar
                $itens = array();
                if (preg_match_all('(\{[a-z0-9]{1,}\})', $pt, $m)) {
                    $itens = preg_replace('(\{|\})', '', $m[0]);
                }

                // Faz a associação
                $arg = array();
                foreach ($matches as $key => $match) {
                    $arg[$itens[$key]] = $match;
                }

                // monta a nova url
                foreach ($arg as $key => $value) {
                    $newurl = str_replace(':' . $key, $value, $newurl);
                }

                $url = $newurl;

                break;
            }
        }

        return $url;

    }

}