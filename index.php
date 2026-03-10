<?php

require __DIR__ . '/vendor/autoload.php';

// Load environment variables
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Load database configuration
require __DIR__ . '/config/database.php';

// Import classes
use App\Controllers\CatController;
use App\Models\CatModel;

// Initialize database connection
$db = getConnection();

// Initialize model
$catModel = new CatModel($db);

// Initialize controller
$catController = new CatController($catModel);

// Initialize router
$router = new \Bramus\Router\Router();

// Welcome route
$router->get('/', function() {
    echo "Welcome to the AUF SIA API Platform";
});

// Cats routes
$router->get('/cats', [$catController, 'index']);
$router->get('/cats/(\d+)', [$catController, 'show']);
$router->post('/cats', [$catController, 'store']);
$router->put('/cats/(\d+)', [$catController, 'update']);
$router->patch('/cats/(\d+)', [$catController, 'update']);
$router->delete('/cats/(\d+)', [$catController, 'destroy']);

// Run the router
$router->run();
