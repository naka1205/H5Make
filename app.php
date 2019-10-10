<?php
require __DIR__ . '/vendor/autoload.php';

define('DS', DIRECTORY_SEPARATOR);
define('IS_CLI', PHP_SAPI == 'cli' ? true : false);
define('IS_WIN', strpos(PHP_OS, 'WIN') !== false);
define('TEMPLATE_PATH', __DIR__ . DS . 'template');

use Naka507\Koa\Application;
use Naka507\Koa\Context;
use Naka507\Koa\Error;
use Naka507\Koa\Timeout;
use Naka507\Koa\NotFound;
use Naka507\Koa\Router;
use Naka507\Koa\StaticFiles; 
use Middlewares\BodyJson; 
use Middlewares\Cors; 
use Middlewares\WebToken; 

$app = new Application();
$app->υse(new Error());
$app->υse(new Timeout(5));
$app->υse(new NotFound()); 

$public =  __DIR__ . DS . 'public';
$app->υse(new StaticFiles($public)); 

$app->υse(new Cors()); 
$app->υse(new BodyJson()); 
$app->υse(new WebToken('my_token',['/auth/login'])); 

require __DIR__ . DS . "db.php";

$routes = require __DIR__ . DS . "routes.php";
$app->υse($routes->routes());

$app->listen(88,function(){
    echo "[demo] start-quick is starting at port 88 \n";
});