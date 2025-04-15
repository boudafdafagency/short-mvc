<?php
// Prevent direct access
if (basename($_SERVER['PHP_SELF']) == 'config.php') {
    http_response_code(403);
    die('Access denied');
}

return [
    'db' => [
        'host' => 'localhost',
        'dbname' => 'null',
        'user' => 'root',
        'password' => '',
    ],
    "base_path" => "/reactivux/2-LACASADECOM/website-lacasadecom",
    "base_public" => "/reactivux/2-LACASADECOM/website-lacasadecom/public",
    "view_path" => __DIR__ . '/../views/pages/',
    "landing_path" => __DIR__ . '/../landingpage/pages/',

    // "base_path" => "",
    // "base_public" => "/public",
    // "view_path" => __DIR__ . '/../views/pages/',
    //"landing_path" => __DIR__ . '/../landingpage/pages/',

];