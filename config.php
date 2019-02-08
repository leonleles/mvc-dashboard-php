<?php
require 'environment.php';
$config = array();

// Protocolo de acesso
define("HTTP", (isset($_SERVER['HTTPS']) ? "https" : "http"));

// Porta para o caminho
$port = ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) ? ":" . $_SERVER['SERVER_PORT'] : "";

// Trata Caminho
$dir = explode($_SERVER['DOCUMENT_ROOT'], str_replace("\\", "/", __DIR__));

$base = '//' . str_replace("//", "/", $_SERVER['SERVER_NAME'] . $port . '/' . $dir[1] . "/");

// Caminho da URL ate o site sem os parametros da url amigavel
define("BASE_URL", $base);

// Dominio do site
define("DOMAIN", "//" . $_SERVER['SERVER_NAME'] . $port . "/");

// URL real atual
define("URL", "//" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

date_default_timezone_set("America/Sao_Paulo");

if (ENVIRONMENT == 'development') {

    $config['dbname'] = '';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
} else {

    $config['dbname'] = '';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
}

global $db;
try {

//    $db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'],
//        $config['dbuser']);
    $db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=utf8',
        $config['dbuser'], $config['dbpass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
