<?php
$host = 'localhost';
$dbname = 'link_catalog';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Помилка підключення: " . $e->getMessage());
}

function isAuthenticated() {
    return isset($_SESSION['user_id']);
}

function getMenuItems() {
    global $db;
    $stmt = $db->query("SELECT * FROM menu_items WHERE is_active = 1 ORDER BY order_index");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
