<?php
use Naka507\Koa\Router;
$router = new Router();
$router->mount('/auth', function() use ($router) {
    $router->get('/login', ['Controllers\Auth', 'login']);
    $router->post('/login', ['Controllers\Auth', 'login']);
    $router->post('/register', ['Controllers\Auth', 'register']);
});
$router->mount('/api/pages', function() use ($router) {
    $router->get('/', ['Controllers\Page', 'index']);
    $router->get('/(\d+)', ['Controllers\Page', 'show']);
});
return $router;