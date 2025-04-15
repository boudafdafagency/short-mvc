<?php
use Core\Router;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/core/Helpers.php';
require_once  'core/Router.php';
 
// Get the current URL path
$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// Extract the filename from the URL path
$filename = basename($urlPath);
// Check if the filename has a .php extension
if (pathinfo($filename, PATHINFO_EXTENSION) === 'php') {
    http_response_code(403);
    die('Access denied');
}  

// Initialize and dispatch the router
$router = new Router();

$currentRoute = $router->currentRoute();
 
// If the path is '/', handle it as 'home' or similar as needed
if ($currentRoute === 'accueil' || $currentRoute === '' || $currentRoute === '/'  ) {
    $currentRoute = 'home'; // Default route name
}
 
error_reporting(E_ALL);
ini_set('display_errors', 1);
  
$router->dispatch( $currentRoute);
