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
    $router->get('/([a-z0-9_-]+)', ['Controllers\Page', 'show']);
    $router->put('/([a-z0-9_-]+)', ['Controllers\Page', 'update']);
});

$router->mount('/api/upload', function() use ($router) {
    $router->get('/theme/([a-z0-9_-]+)', ['Controllers\Upload', 'theme']);
});

return $router;