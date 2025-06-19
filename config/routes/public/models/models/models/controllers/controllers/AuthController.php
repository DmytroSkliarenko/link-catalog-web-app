<?php
require_once '../models/User.php';

function showLogin() {
    if (isAuthenticated()) {
        header('Location: /link-catalog/public/admin/links');
        exit;
    }
    
    $title = "Вхід до системи";
    $content = renderView('../views/auth/login.php');
    include '../views/layouts/main.php';
}

function processLogin() {
    global $db;
    $userModel = new User($db);
    
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $user = $userModel->authenticate($username, $password);
    
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: /link-catalog/public/admin/links');
        exit;
    } else {
        $error = "Невірний логін або пароль";
        $title = "Вхід до системи";
        $content = renderView('../views/auth/login.php', compact('error'));
        include '../views/layouts/main.php';
    }
}

function processLogout() {
    session_destroy();
    header('Location: /link-catalog/public/');
    exit;
}

function renderView($viewPath, $data = []) {
    extract($data);
    ob_start();
    include $viewPath;
    return ob_get_clean();
}
?>
