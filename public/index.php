<?php
require __DIR__ . '/../config/Database.php';
require __DIR__ . '/../src/Router.php';
require __DIR__ . '/../src/Controllers/UserController.php';

use Src\Router;
use Src\Controllers\UserController;

$pdo = Database::getInstance();
$userController = new UserController($pdo);

$router = new Router('/api-php-native-crud/public');

// Semua route CRUD
$router->add('GET', '/api/v1/users', [$userController, 'index']);
$router->add('GET', '/api/v1/users/{id}', [$userController, 'show']);
$router->add('POST', '/api/v1/users', [$userController, 'store']);
$router->add('PUT', '/api/v1/users/{id}', [$userController, 'update']);
$router->add('DELETE', '/api/v1/users/{id}', [$userController, 'destroy']);

$router->run();
