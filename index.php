<?php
session_start();
require __DIR__.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute(['GET'], '/', ['Src\front\Controllers\HomePageController', 'index']);
    $r->addRoute(['GET'], '/login', ['Src\front\Controllers\UserFrontController', 'login']);
    $r->addRoute(['GET'], '/register', ['Src\front\Controllers\UserFrontController', 'register']);
    $r->addRoute(['GET'], '/account', ['Src\front\Controllers\UserFrontController', 'account']);
    $r->addRoute(['POST'], '/login-submit', ['Src\admin\Controllers\UserAdminController', 'loginSubmit']);
    $r->addRoute(['POST'], '/register-submit', ['Src\admin\Controllers\UserAdminController', 'registerSubmit']);
    $r->addRoute(['GET'], '/logout', ['Src\admin\Controllers\UserAdminController', 'logout']);
    $r->addRoute(['POST'], '/pdfdownload', ['Src\admin\Controllers\UserAdminController', 'downloadPdf']);
    $r->addRoute(['POST'], '/sendPdfByEmail', ['Src\admin\Controllers\UserAdminController', 'sendPdfByEmail']);
    $r->addRoute(['GET'], '/allusersexport', ['Src\admin\Controllers\UserAdminController', 'exportAllUsers']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo("405");
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $controller = new $handler[0]();
        $method = $handler[1];
        $controller->$method($vars);

        break;
}