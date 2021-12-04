<?php

//session_start();

define("BASE_PATH", __DIR__);
define('ENCRYPTION_KEY', '!@@#%_my_serect_key_for_encrytion_@#$!&');

require "../vendor/autoload.php";

use Illuminate\Config\Repository;

$configPath = BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR;

$config = new Repository();
foreach (glob($configPath . '*.php') as $phpFile) {
    $config->set(
        basename($phpFile, '.php'),
        require_once "$phpFile"
    );
}

$dbConfig = $config->get("app.db");

$session = new \App\Http\Session\Session();
$session->start();

$request = \App\Http\Request::createFromGlobals();

$routesPath = BASE_PATH . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR;
foreach(glob($routesPath . '*.php') as $phpFile){
    require_once "$phpFile";
}


use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$capsule->addConnection($dbConfig);

$capsule->setAsGlobal();
$capsule->bootEloquent();


