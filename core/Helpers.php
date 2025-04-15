<?php
// core/Helpers.php
// Prevent direct access
if (basename($_SERVER['PHP_SELF']) == 'Helpers.php') {
    http_response_code(403);
    die('Access denied');
}
$config = require __DIR__ . '/../config/config.php';
if (!function_exists('asset')) {
    function asset($path) {
        global $config;  
        // Detect the scheme (http or https) and host dynamically
        $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
        $baseUrl .= $config['base_public'] ;
       
        // Combine the base URL with the given path
       return $baseUrl . '/' . trim($path, '/');
       // dd($c) ;
    } 

    function url($path) {
        global $config;  
        // Detect the scheme (http or https) and host dynamically
        $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
        $baseUrl .= $config['base_path'];  
        // Combine the base URL with the given path
        return $baseUrl . '/' . trim($path, '/');
    }
}