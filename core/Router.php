<?php

namespace core;
// Prevent direct access
if (basename($_SERVER['PHP_SELF']) == 'Router.php') {
    http_response_code(403);
    die('Access denied');
}
$config = require __DIR__ . '/../config/config.php';
class Router
{
    private $routes = [
        'GET' => [],
        'POST' => [],
        'DELETE' => [],
        'PATCH' => []
    ];
    
    public function __construct()
    {
        // Define your routes here
        $this->get('home', 'HomeController@index');
        
        $this->post('contact', 'ContactsController@handleContact');

    
        // landing page
        $this->get('creation-site-web', 'LandingPageController@creationWebsite'); 
        $this->post('contact/{siteweb}', 'ContactsController@handleLandingContact');

        // sitemap
        $this->get('sitemaps', 'SitemapController@sitemap');

    }

    public function get($uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action)
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function delete($uri, $action)
    {
        $this->routes['DELETE'][$uri] = $action;
    }

    public function patch($uri, $action)
    {
        $this->routes['PATCH'][$uri] = $action;
    }

    public function dispatch($uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = trim(parse_url($uri, PHP_URL_PATH), '/');

        // Iterate over the routes to find a match
        foreach ($this->routes[$method] as $route => $action) {
            // Convert route to a regex pattern for dynamic parameters
            $pattern = preg_replace('~\{[a-zA-Z]+\}~', '([^/]+)', $route);
            $pattern = "~^$pattern$~";

            // Check if the URI matches the route pattern
            if (preg_match($pattern, $uri, $matches)) {
                list($controllerName, $method) = explode('@', $action);
                $controller = 'app\\controllers\\' . $controllerName;

                if (class_exists($controller)) {
                    array_shift($matches); // Remove the full match
                    (new $controller)->$method(...$matches); // Pass parameters to controller method
                    return;
                } else {
                    http_response_code(500);
                    echo "Controller class '$controller' not found.";
                    return;
                }
            }
        }

        // No route matched; default to 404 handler
        $controller = 'app\\controllers\\NotFoundController';
        if (class_exists($controller)) {

            (new $controller)->index();
        } else {
            http_response_code(500);
            echo "Controller class '$controller' not found.";
        }
    }

    public function currentRoute()
    {
        global $config;
        // Get the full path from the current URL
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // Define your project's root path
        $basePath = $config['base_path'];
        // Remove the base path from the full path to get the route from "blogs/..."
        $currentRoute = ltrim(str_replace($basePath, '', $path), '/');
        return $currentRoute;
    }
}
