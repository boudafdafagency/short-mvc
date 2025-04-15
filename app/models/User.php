<?php
namespace app\models;  // Adjusted namespace
// Prevent direct access
if (basename($_SERVER['PHP_SELF']) == 'User.php') {
    http_response_code(403);
    die('Access denied');
}
use core\Database;
use PDO;
class User {
    public static function getAllUsers() {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM members";

        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUserById($id) {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM members WHERE id = :id"; // Assuming 'id' is the column name

        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Bind the parameter to prevent SQL injection
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Return the user as an associative array
    }
}
