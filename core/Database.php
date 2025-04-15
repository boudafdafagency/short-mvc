<?php
namespace core;

use PDO;
use PDOException;
// Prevent direct access
if (basename($_SERVER['PHP_SELF']) == 'Database.php') {
    http_response_code(403);
    die('Access denied');
}
class Database {
    private $connection;
     private static $instance = null;
    public function __construct() {
        $config = require __DIR__ . '/../config/config.php';
        try {
            $this->connection = new PDO(
                "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']}",
                $config['db']['user'],
                $config['db']['password']
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
 

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
