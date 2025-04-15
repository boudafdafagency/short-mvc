<?php
namespace core;
// Prevent direct access
if (basename($_SERVER['PHP_SELF']) == 'Controller.php') {
    http_response_code(403);
    die('Access denied');
}
 class Controller {
    // Method to render views
    protected function render($view, $data = []) {
        // Set the path to your views directory
        global $config;
        $viewPath = $config['view_path'] . $view . '.php';  
        // Check if the view file exists
        if (file_exists($viewPath)) { 
            extract($data);
            // Include header and footer around the view content
            include __DIR__ . '/../views/layouts/header.php';
            include $viewPath;
            include __DIR__ . '/../views/layouts/footer.php';
        } else {
            http_response_code(404);
            echo "View '$view' not found.";
        }
    }


    protected function renderLandingpage($view, $data = []) {
        // Set the path to your views landingpage directory
        global $config;
        $viewPath = $config['landing_path'] . $view . '.php';  
        // Check if the view file exists
        if (file_exists($viewPath)) { 
            extract($data);
            // Include header and footer around the view content
            include __DIR__ . '/../landingpage/layouts/header.php';
            include $viewPath;
            include __DIR__ . '/../landingpage/layouts/footer.php';
        } else {
            http_response_code(404);
            echo "View '$view' not found.";
        }
    }
}
